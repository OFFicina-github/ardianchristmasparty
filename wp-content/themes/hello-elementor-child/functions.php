<?php
add_action('wp_enqueue_scripts', function () {

    // 1. Carica gli stili base del tema parent e child
    wp_enqueue_style(
        'hello-elementor-style',
        get_template_directory_uri() . '/style.css'
    );

    wp_enqueue_style(
        'hello-elementor-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        ['hello-elementor-style']
    );

    // 2. Carica automaticamente tutti i .css nella cartella /assets/scss/
    $scss_dir = get_stylesheet_directory() . '/assets/scss/';
    $scss_uri = get_stylesheet_directory_uri() . '/assets/scss/';

    if (file_exists($scss_dir)) {
        foreach (glob($scss_dir . '*.css') as $css_file) {
            $handle = 'child-' . basename($css_file, '.css');
            wp_enqueue_style($handle, $scss_uri . basename($css_file), ['hello-elementor-child-style']);
        }
    }
});


function hello_child_enqueue_bootstrap()
{
    // === Bootstrap CSS ===
    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        array(), // Nessuna dipendenza
        '5.3.3' // Versione
    );

    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        array('jquery'), // jQuery è già incluso da WordPress
        '5.3.3',
        true // Carica in footer
    );
}
add_action('wp_enqueue_scripts', 'hello_child_enqueue_bootstrap');


function wpcontent_svg_mime_type($mimes = array())
{
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'wpcontent_svg_mime_type');

add_action('get_footer', function () {
    // Percorso al footer personalizzato nel child theme
    $child_footer = get_stylesheet_directory() . '/template-parts/dynamic-footer.php';

    if (file_exists($child_footer)) {
        // Disattiva il footer originale
        remove_all_actions('hello_elementor_footer');

        // Includi il tuo file
        add_action('hello_elementor_footer', function () use ($child_footer) {
            include $child_footer;

        });
    }
}, 5);

function child_theme_scripts()
{
    // Assicura che jQuery sia caricato
    wp_enqueue_script('jquery');

    // Carica il tuo script personalizzato
    wp_enqueue_script(
        'child-custom-script',
        get_stylesheet_directory_uri() . '/assets/scripts/script.js',
        array('jquery'),
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'child_theme_scripts');

add_action('wpcf7_mail_sent', 'salva_dati_iscrizione_cf7');
function salva_dati_iscrizione_cf7($contact_form)
{
    global $wpdb;
    $submission = WPCF7_Submission::get_instance();
    if (!$submission) {
        return;
    }

    $data = $submission->get_posted_data();

    // Debug temporaneo

    error_log(print_r($data, true)); // utile per verificare cosa arriva

    $table_name = $wpdb->prefix . 'iscrizioni_evento';

    // Assicurati che tutti i campi esistano prima di inserirli
    $nome = isset($data['your-name']) ? sanitize_text_field($data['your-name']) : '';
    $cognome = isset($data['cognome']) ? sanitize_text_field($data['cognome']) : '';
    $email = isset($data['your-email']) ? sanitize_email($data['your-email']) : '';
    $azienda = isset($data['azienda']) ? sanitize_text_field($data['azienda']) : '';
    $partecipa = isset($data['partecipa']) && sanitize_text_field($data['partecipa']) === 'true' ? 'si' : 'no';

    if (!empty($email)) {
        $wpdb->insert($table_name, [
            'email' => $email,
            'name' => $nome,
            'lastname' => $cognome,
            'company' => $azienda,
            'partecipa' => $partecipa,
        ]);
    }
}

function shortcode_iscrizione_evento()
{

    ob_start(); ?>
    <div class="iscrizione-evento custom-shortcode partecipo-block">

        <?php echo do_shortcode('[contact-form-7 id="748" title="Modulo Partecipa"]'); ?>

        <div class="save-date mb-4 pb-2 hidden fade-out">
            <h2 class="mt-0 mb-4 pb-2 text-white">SAVE THE DATE</h2>

            <div class="button-field">
                <!-- Pulsante Google Calendar -->
                <a class="btn btn-primary"
                    href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=Christmas+Cocktail&dates=20251215T183000/20251215T223000&details=Ti+aspettiamo+al+Christmas+Cocktail%21&location=Galleria+de+Cristoforis%2C+1+-+Milano"
                    target="_blank">
                    AGGIUNGERE A GOOGLE CALENDAR
                </a>

                <!-- Pulsante file .ICS -->
                <a class="btn btn-primary"
                    href="data:text/calendar;charset=utf-8,BEGIN:VCALENDAR%0AVERSION:2.0%0APRODID:-//OFF//IT%0ABEGIN:VEVENT%0AUID:20251215T183000-christmascocktail@offitaly.it%0ADTSTAMP:20251215T183000%0ADTSTART:20251215T183000%0ADTEND:20251215T223000%0ASUMMARY:Christmas%20Cocktail%0ADESCRIPTION:La%20aspettiamo%20al%20Christmas%20Cocktail%21%0ALOCATION:Galleria%20de%20Cristoforis%2C%201%20-%20Milano%0AEND:VEVENT%0AEND:VCALENDAR"
                    download="christmas-cocktail.ics">
                    SCARICARE FILE .ICS
                </a>

            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('iscrizione_evento', 'shortcode_iscrizione_evento');

function shortcode_iscrizione_evento_non_partecipa()
{
    ob_start(); ?>
    <div class="iscrizione-evento custom-shortcode non-partecipo-block">

        <?php echo do_shortcode('[contact-form-7 id="747" title="Modulo NON Partecipa"]'); ?>

        <div class="show-after mb-3 hidden fade-out">
            <h2 class="text-white">Il Team Ardian Real Estate </br>le augura Buone Feste.</h2>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('iscrizione_evento_non_partecipa', 'shortcode_iscrizione_evento_non_partecipa');


add_filter('wpcf7_validate_email*', 'controlla_email_gia_inserita', 10, 2);

function controlla_email_gia_inserita($result, $tag)
{
    global $wpdb;

    $name = $tag->name; // es. "your-email"

    // Recupera il valore inviato
    $submission = WPCF7_Submission::get_instance();
    if (!$submission)
        return $result;

    $data = $submission->get_posted_data();
    if (!isset($data[$name]))
        return $result;

    $email = sanitize_email($data[$name]);
    $table_name = $wpdb->prefix . 'iscrizioni_evento';

    // Controlla se l'email è già in DB
    $exists = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE email = %s", $email));

    if ($exists > 0) {
        // Blocca invio + messaggio di errore personalizzato
        $result->invalidate($tag, "Questa email risulta già registrata per l’evento.");
    }

    return $result;
}