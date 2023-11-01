<?php
/**
 * Plugin Name:     Omnigo Livechat
 * Plugin URI:      https://omnigo.id/
 * Description:     Omnigo Plugin for WordPress. This plugin helps you to quickly integrate Omnigo live-chat widget on Wordpress websites.
 * Author:          heerrr
 * Author URI:      omnigo.id
 * Text Domain:     omnigo-plugin
 * Version:         0.1
 *
 * @package         omnigo-plugin
 */

add_action('admin_enqueue_scripts', 'admin_styles');
/**
 * Load Omnigo Admin CSS.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function admin_styles()
{
    wp_enqueue_style('admin-styles', plugin_dir_url(__FILE__) . '/admin.css');
}

 add_action('wp_enqueue_scripts', 'omnigo_assets');
/**
 * Load Omnigo Assets.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function omnigo_assets()
{
    wp_enqueue_script('omnigo-client', plugins_url('/js/omnigo.js', __FILE__));
}

add_action('wp_enqueue_scripts', 'omnigo_load');
/**
 * Initialize embed code options.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function omnigo_load()
{

  // Get our site options for site url and token.
    $omnigo_url = get_option('omnigoSiteURL');
    $omnigo_token = get_option('omnigoSiteToken');
    $omnigo_widget_locale = get_option('omnigoWidgetLocale');
    $omnigo_widget_type = get_option('omnigoWidgetType');
    $omnigo_widget_position = get_option('omnigoWidgetPosition');
    $omnigo_launcher_text = get_option('omnigoLauncherText');

    // Localize our variables for the Javascript embed code.
    wp_localize_script('omnigo-client', 'omnigo_token', $omnigo_token);
    wp_localize_script('omnigo-client', 'omnigo_url', $omnigo_url);
    wp_localize_script('omnigo-client', 'omnigo_widget_locale', $omnigo_widget_locale);
    wp_localize_script('omnigo-client', 'omnigo_widget_type', $omnigo_widget_type);
    wp_localize_script('omnigo-client', 'omnigo_launcher_text', $omnigo_launcher_text);
    wp_localize_script('omnigo-client', 'omnigo_widget_position', $omnigo_widget_position);
}

add_action('admin_menu', 'omnigo_setup_menu');
/**
 * Set up Settings options page.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function omnigo_setup_menu()
{
    add_options_page('Option', 'Omnigo Settings', 'manage_options', 'omnigo-plugin-options', 'omnigo_options_page');
}

add_action('admin_init', 'omnigo_register_settings');
/**
 * Register Settings.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function omnigo_register_settings()
{
    add_option('omnigoSiteToken', '');
    add_option('omnigoSiteURL', '');
    add_option('omnigoWidgetLocale', 'en');
    add_option('omnigoWidgetType', 'standard');
    add_option('omnigoWidgetPosition', 'right');
    add_option('omnigoLauncherText', '');

    register_setting('omnigo-plugin-options', 'omnigoSiteToken');
    register_setting('omnigo-plugin-options', 'omnigoSiteURL');
    register_setting('omnigo-plugin-options', 'omnigoWidgetLocale');
    register_setting('omnigo-plugin-options', 'omnigoWidgetType');
    register_setting('omnigo-plugin-options', 'omnigoWidgetPosition');
    register_setting('omnigo-plugin-options', 'omnigoLauncherText');
}

/**
 * Render page.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function omnigo_options_page()
{
    ?>
  <div>
    <h2>Omnigo Settings</h2>
    <form method="post" action="options.php" class="omnigo--form">
      <?php settings_fields('omnigo-plugin-options'); ?>
      <div class="form--input">
        <label for="omnigoSiteToken">Omnigo Website Token</label>
        <input
          type="text"
          name="omnigoSiteToken"
          value="<?php echo get_option('omnigoSiteToken'); ?>"
        />
      </div>
      <hr />
      <div class="form--input">
        <label for="omnigoWidgetType">Widget Design</label>
        <select name="omnigoWidgetType">
          <option value="standard" <?php selected(get_option('omnigoWidgetType'), 'standard'); ?>>Standard</option>
          <option value="expanded_bubble" <?php selected(get_option('omnigoWidgetType'), 'expanded_bubble'); ?>>Expanded Bubble</option>
        </select>
      </div>
      <div class="form--input">
        <label for="omnigoWidgetPosition">Widget Position</label>
        <select name="omnigoWidgetPosition">
          <option value="left" <?php selected(get_option('omnigoWidgetPosition'), 'left'); ?>>Left</option>
          <option value="right" <?php selected(get_option('omnigoWidgetPosition'), 'right'); ?>>Right</option>
        </select>
      </div>
      <div class="form--input">
        <label for="omnigoWidgetLocale">Language</label>
        <select name="omnigoWidgetLocale">
          <option <?php selected(get_option('omnigoWidgetLocale'), 'ar'); ?> value="ar">العربية (ar)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'ca'); ?> value="ca">Català (ca)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'cs'); ?> value="cs">čeština (cs)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'da'); ?> value="da">dansk (da)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'de'); ?> value="de">Deutsch (de)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'el'); ?> value="el">ελληνικά (el)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'en'); ?> value="en">English (en)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'es'); ?> value="es">Español (es)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'fa'); ?> value="fa">فارسی (fa)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'fi'); ?> value="fi">suomi, suomen kieli (fi)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'fr'); ?> value="fr">Français (fr)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'hi'); ?> value="hi'">हिन्दी (hi)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'hu'); ?> value="hu">magyar nyelv (hu)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'id'); ?> value="id">Bahasa Indonesia (id)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'it'); ?> value="it">Italiano (it)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'ja'); ?> value="ja">日本語 (ja)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'ko'); ?> value="ko">한국어 (ko)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'ml'); ?> value="ml">മലയാളം (ml)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'nl'); ?> value="nl">Nederlands (nl) </option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'no'); ?> value="no">norsk (no)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'pl'); ?> value="pl">język polski (pl)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'pt_BR'); ?> value="pt_BR">Português Brasileiro (pt-BR)
          <option <?php selected(get_option('omnigoWidgetLocale'), 'pt'); ?> value="pt">Português (pt)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'ro'); ?> value="ro">Română (ro)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'ru'); ?> value="ru">русский (ru)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'sv'); ?> value="sv">Svenska (sv)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'ta'); ?> value="ta">தமிழ் (ta)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'tr'); ?> value="tr">Türkçe (tr)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'vi'); ?> value="vi">Tiếng Việt (vi)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'zh_CN'); ?> value="zh_CN">中文 (zh-CN)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'zh_TW'); ?> value="zh_TW">中文 (台湾) (zh-TW)</option>
          <option <?php selected(get_option('omnigoWidgetLocale'), 'zh'); ?> value="zh'">中文 (zh)</option>
        </select>
      </div>
      <?php if (get_option('omnigoWidgetType') == 'expanded_bubble') : ?>
        <div class="form--input">
          <label for="omnigoLauncherText">Launcher Text (Optional)</label>
          <input
            type="text"
            name="omnigoLauncherText"
            value="<?php echo get_option('omnigoLauncherText'); ?>"
          />
        </div>
      <?php endif; ?>
      <?php submit_button(); ?>
    </form>
  </div>
<?php
}
