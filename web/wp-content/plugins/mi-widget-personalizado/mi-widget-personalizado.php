<?php
/*
Plugin Name: Pedidos Crochet (Shortcode)
Description: Formulario centrado para encargos de crochet con panel de gestión.
Version: 3.0
Author: Jose Ruz Domínguez
*/

if (!defined('ABSPATH')) exit;

global $wpdb;
define('CROCHET_TABLA', $wpdb->prefix . 'pedidos_crochet');


// ===== CREAR TABLA AL ACTIVAR =====
register_activation_hook(__FILE__, function () {
    global $wpdb;

    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE " . CROCHET_TABLA . " (
        id INT NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        descripcion TEXT NOT NULL,
        fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
});


// ===== SHORTCODE DEL FORMULARIO =====
add_shortcode('pedido_crochet', function () {

    ob_start();

    if (isset($_POST['pedido_crochet']) && wp_verify_nonce($_POST['crochet_nonce'], 'enviar_pedido')) {

        global $wpdb;

        $nombre = sanitize_text_field($_POST['nombre']);
        $email = sanitize_email($_POST['email']);
        $descripcion = sanitize_textarea_field($_POST['descripcion']);

        $wpdb->insert(
            CROCHET_TABLA,
            array(
                'nombre' => $nombre,
                'email' => $email,
                'descripcion' => $descripcion
            )
        );

        echo "<p class='crochet-ok'>¡Pedido enviado correctamente!</p>";
    }
    ?>

    <div class="crochet-form-centro">
        <form method="post">
            <?php wp_nonce_field('enviar_pedido', 'crochet_nonce'); ?>

            <input type="text" name="nombre" placeholder="Tu nombre" required>
            <input type="email" name="email" placeholder="Tu email" required>
            <textarea name="descripcion" placeholder="¿Qué quieres que te hagamos?" required></textarea>
            <input type="submit" name="pedido_crochet" value="Enviar pedido">
        </form>
    </div>

    <?php
    return ob_get_clean();
});


// ===== CSS DEL FORMULARIO =====
add_action('wp_head', function () {
?>
<style>
.crochet-form-centro {
    max-width: 600px;
    margin: 40px auto;
    background: #fff8f5;
    padding: 25px;
    border-radius: 12px;
    border: 1px solid #f0d6cf;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.crochet-form-centro input,
.crochet-form-centro textarea {
    width: 100%;
    padding: 12px;
    margin-top: 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-family: inherit;
}

.crochet-form-centro input[type="submit"] {
    background: #ff8fa3;
    color: white;
    border: none;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.crochet-form-centro input[type="submit"]:hover {
    background: #ff6f8b;
}

.crochet-ok {
    text-align: center;
    color: green;
    font-weight: bold;
}
</style>
<?php
});


// ===== PANEL ADMIN PARA VER PEDIDOS =====
add_action('admin_menu', function () {
    add_menu_page(
        'Pedidos Crochet',
        'Pedidos Crochet',
        'manage_options',
        'pedidos-crochet',
        'crochet_panel_admin',
        'dashicons-heart',
        26
    );
});

function crochet_panel_admin() {
    global $wpdb;

    $pedidos = $wpdb->get_results("SELECT * FROM " . CROCHET_TABLA . " ORDER BY fecha DESC");

    echo "<div class='wrap'><h1>Pedidos recibidos</h1>";
    echo "<table class='widefat striped'>";
    echo "<thead><tr>
        <th>Nombre</th>
        <th>Email</th>
        <th>Pedido</th>
        <th>Fecha</th>
    </tr></thead><tbody>";

    foreach ($pedidos as $p) {
        echo "<tr>
            <td>{$p->nombre}</td>
            <td>{$p->email}</td>
            <td>{$p->descripcion}</td>
            <td>{$p->fecha}</td>
        </tr>";
    }

    echo "</tbody></table></div>";
}
