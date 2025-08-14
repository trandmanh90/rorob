<?php
/**
 * Widget: Social Links
 *
 * @since Halva Additional Features 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Register widget
 */
add_action( 'widgets_init', 'halva_additional_features_register_social_widget' );

function halva_additional_features_register_social_widget() {
	register_widget( 'halva_additional_features_social_widget' );
}


/**
 * Class halva_additional_features_social_widget
 */
class halva_additional_features_social_widget extends WP_Widget {

	/**
	 * Sets up the widget name, description, class, etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'		=> 'widget_bwp_social',
			'description'	=> esc_html__( 'Displays links to social profiles.', 'halva-additional-features' ),
		);
		parent::__construct( 'halva_social_widget', esc_html__( 'Halva: Social Links', 'halva-additional-features' ), $widget_ops );
	}

	/**
	 * Outputs the options form on admin
	 */
	public function form( $instance ) {
		// defaults
		$title_instance = isset( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : '';
		$twitter_url_instance = isset( $instance['twitter_url'] ) ? sanitize_text_field( $instance['twitter_url'] ) : '';
		$facebook_url_instance = isset( $instance['facebook_url'] ) ? sanitize_text_field( $instance['facebook_url'] ) : '';
		$pinterest_url_instance = isset( $instance['pinterest_url'] ) ? sanitize_text_field( $instance['pinterest_url'] ) : '';
		$telegram_url_instance = isset( $instance['telegram_url'] ) ? sanitize_text_field( $instance['telegram_url'] ) : '';
		$reddit_url_instance = isset( $instance['reddit_url'] ) ? sanitize_text_field( $instance['reddit_url'] ) : '';
		$tiktok_url_instance = isset( $instance['tiktok_url'] ) ? sanitize_text_field( $instance['tiktok_url'] ) : ''; // * *
		$discord_url_instance = isset( $instance['discord_url'] ) ? sanitize_text_field( $instance['discord_url'] ) : ''; // * *
		$vk_url_instance = isset( $instance['vk_url'] ) ? sanitize_text_field( $instance['vk_url'] ) : '';
		$odnoklassniki_url_instance = isset( $instance['odnoklassniki_url'] ) ? sanitize_text_field( $instance['odnoklassniki_url'] ) : ''; // * *
		$yandex_url_instance = isset( $instance['yandex_url'] ) ? sanitize_text_field( $instance['yandex_url'] ) : ''; // * *
		$linkedin_url_instance = isset( $instance['linkedin_url'] ) ? sanitize_text_field( $instance['linkedin_url'] ) : '';
		$paypal_url_instance = isset( $instance['paypal_url'] ) ? sanitize_text_field( $instance['paypal_url'] ) : ''; // * *
		$patreon_url_instance = isset( $instance['patreon_url'] ) ? sanitize_text_field( $instance['patreon_url'] ) : ''; // * *
		$etsy_url_instance = isset( $instance['etsy_url'] ) ? sanitize_text_field( $instance['etsy_url'] ) : ''; // * *
		$amazon_url_instance = isset( $instance['amazon_url'] ) ? sanitize_text_field( $instance['amazon_url'] ) : ''; // * *
		$flickr_url_instance = isset( $instance['flickr_url'] ) ? sanitize_text_field( $instance['flickr_url'] ) : '';
		$instagram_url_instance = isset( $instance['instagram_url'] ) ? sanitize_text_field( $instance['instagram_url'] ) : '';
		$deviantart_url_instance = isset( $instance['deviantart_url'] ) ? sanitize_text_field( $instance['deviantart_url'] ) : ''; // * *
		$youtube_url_instance = isset( $instance['youtube_url'] ) ? sanitize_text_field( $instance['youtube_url'] ) : '';
		$vimeo_url_instance = isset( $instance['vimeo_url'] ) ? sanitize_text_field( $instance['vimeo_url'] ) : '';
		$twitch_url_instance = isset( $instance['twitch_url'] ) ? sanitize_text_field( $instance['twitch_url'] ) : ''; // * *
		$soundcloud_url_instance = isset( $instance['soundcloud_url'] ) ? sanitize_text_field( $instance['soundcloud_url'] ) : '';
		$spotify_url_instance = isset( $instance['spotify_url'] ) ? sanitize_text_field( $instance['spotify_url'] ) : ''; // * *
		$dribbble_url_instance = isset( $instance['dribbble_url'] ) ? sanitize_text_field( $instance['dribbble_url'] ) : '';
		$behance_url_instance = isset( $instance['behance_url'] ) ? sanitize_text_field( $instance['behance_url'] ) : '';
		$github_url_instance = isset( $instance['github_url'] ) ? sanitize_text_field( $instance['github_url'] ) : '';
		$stack_overflow_url_instance = isset( $instance['stack_overflow_url'] ) ? sanitize_text_field( $instance['stack_overflow_url'] ) : '';
		$slack_url_instance = isset( $instance['slack_url'] ) ? sanitize_text_field( $instance['slack_url'] ) : '';
		$mailchimp_url_instance = isset( $instance['mailchimp_url'] ) ? sanitize_text_field( $instance['mailchimp_url'] ) : ''; // * *
		$rss_url_instance = isset( $instance['rss_url'] ) ? sanitize_text_field( $instance['rss_url'] ) : '';
		?>

		<!-- title -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title_instance ); ?>">
		</p>
		<!-- end: title -->

		<!-- twitter -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter_url' ) ); ?>"><?php esc_html_e( 'Twitter X URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'twitter_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter_url' ) ); ?>" value="<?php echo esc_attr( $twitter_url_instance ); ?>">
		</p>
		<!-- end: twitter -->

		<!-- facebook -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook_url' ) ); ?>"><?php esc_html_e( 'Facebook URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'facebook_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook_url' ) ); ?>" value="<?php echo esc_attr( $facebook_url_instance ); ?>">
		</p>
		<!-- end: facebook -->

		<!-- pinterest -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest_url' ) ); ?>"><?php esc_html_e( 'Pinterest URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'pinterest_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest_url' ) ); ?>" value="<?php echo esc_attr( $pinterest_url_instance ); ?>">
		</p>
		<!-- end: pinterest -->

		<!-- telegram -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'telegram_url' ) ); ?>"><?php esc_html_e( 'Telegram URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'telegram_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'telegram_url' ) ); ?>" value="<?php echo esc_attr( $telegram_url_instance ); ?>">
		</p>
		<!-- end: telegram -->

		<!-- reddit -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'reddit_url' ) ); ?>"><?php esc_html_e( 'Reddit URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'reddit_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'reddit_url' ) ); ?>" value="<?php echo esc_attr( $reddit_url_instance ); ?>">
		</p>
		<!-- end: reddit -->

		<!-- tiktok -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tiktok_url' ) ); ?>"><?php esc_html_e( 'TikTok URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'tiktok_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tiktok_url' ) ); ?>" value="<?php echo esc_attr( $tiktok_url_instance ); ?>">
		</p>
		<!-- end: tiktok -->

		<!-- discord -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'discord_url' ) ); ?>"><?php esc_html_e( 'Discord URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'discord_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'discord_url' ) ); ?>" value="<?php echo esc_attr( $discord_url_instance ); ?>">
		</p>
		<!-- end: discord -->

		<!-- vk -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'vk_url' ) ); ?>"><?php esc_html_e( 'VK URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'vk_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vk_url' ) ); ?>" value="<?php echo esc_attr( $vk_url_instance ); ?>">
		</p>
		<!-- end: vk -->

		<!-- odnoklassniki -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'odnoklassniki_url' ) ); ?>"><?php esc_html_e( 'Odnoklassniki URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'odnoklassniki_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'odnoklassniki_url' ) ); ?>" value="<?php echo esc_attr( $odnoklassniki_url_instance ); ?>">
		</p>
		<!-- end: odnoklassniki -->

		<!-- yandex -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'yandex_url' ) ); ?>"><?php esc_html_e( 'Yandex URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'yandex_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'yandex_url' ) ); ?>" value="<?php echo esc_attr( $yandex_url_instance ); ?>">
		</p>
		<!-- end: yandex -->

		<!-- linkedin -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'linkedin_url' ) ); ?>"><?php esc_html_e( 'Linkedin URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'linkedin_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin_url' ) ); ?>" value="<?php echo esc_attr( $linkedin_url_instance ); ?>">
		</p>
		<!-- end: linkedin -->

		<!-- paypal -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'paypal_url' ) ); ?>"><?php esc_html_e( 'PayPal URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'paypal_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'paypal_url' ) ); ?>" value="<?php echo esc_attr( $paypal_url_instance ); ?>">
		</p>
		<!-- end: paypal -->

		<!-- patreon -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'patreon_url' ) ); ?>"><?php esc_html_e( 'Patreon URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'patreon_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'patreon_url' ) ); ?>" value="<?php echo esc_attr( $patreon_url_instance ); ?>">
		</p>
		<!-- end: patreon -->

		<!-- etsy -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'etsy_url' ) ); ?>"><?php esc_html_e( 'Etsy URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'etsy_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'etsy_url' ) ); ?>" value="<?php echo esc_attr( $etsy_url_instance ); ?>">
		</p>
		<!-- end: etsy -->

		<!-- amazon -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'amazon_url' ) ); ?>"><?php esc_html_e( 'Amazon URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'amazon_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'amazon_url' ) ); ?>" value="<?php echo esc_attr( $amazon_url_instance ); ?>">
		</p>
		<!-- end: amazon -->

		<!-- flickr -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'flickr_url' ) ); ?>"><?php esc_html_e( 'Flickr URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'flickr_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickr_url' ) ); ?>" value="<?php echo esc_attr( $flickr_url_instance ); ?>">
		</p>
		<!-- end: flickr -->

		<!-- instagram -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'instagram_url' ) ); ?>"><?php esc_html_e( 'Instagram URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'instagram_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram_url' ) ); ?>" value="<?php echo esc_attr( $instagram_url_instance ); ?>">
		</p>
		<!-- end: instagram -->

		<!-- deviantart -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'deviantart_url' ) ); ?>"><?php esc_html_e( 'Deviantart URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'deviantart_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'deviantart_url' ) ); ?>" value="<?php echo esc_attr( $deviantart_url_instance ); ?>">
		</p>
		<!-- end: deviantart -->

		<!-- YouTube -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'youtube_url' ) ); ?>"><?php esc_html_e( 'YouTube URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'youtube_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube_url' ) ); ?>" value="<?php echo esc_attr( $youtube_url_instance ); ?>">
		</p>
		<!-- end: YouTube -->

		<!-- vimeo -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'vimeo_url' ) ); ?>"><?php esc_html_e( 'Vimeo URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'vimeo_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vimeo_url' ) ); ?>" value="<?php echo esc_attr( $vimeo_url_instance ); ?>">
		</p>
		<!-- end: vimeo -->

		<!-- twitch -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitch_url' ) ); ?>"><?php esc_html_e( 'Twitch URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'twitch_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitch_url' ) ); ?>" value="<?php echo esc_attr( $twitch_url_instance ); ?>">
		</p>
		<!-- end: twitch -->

		<!-- soundcloud -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'soundcloud_url' ) ); ?>"><?php esc_html_e( 'Soundcloud URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'soundcloud_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'soundcloud_url' ) ); ?>" value="<?php echo esc_attr( $soundcloud_url_instance ); ?>">
		</p>
		<!-- end: soundcloud -->

		<!-- spotify -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'spotify_url' ) ); ?>"><?php esc_html_e( 'Spotify URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'spotify_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'spotify_url' ) ); ?>" value="<?php echo esc_attr( $spotify_url_instance ); ?>">
		</p>
		<!-- end: spotify -->

		<!-- dribbble -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'dribbble_url' ) ); ?>"><?php esc_html_e( 'Dribbble URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'dribbble_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dribbble_url' ) ); ?>" value="<?php echo esc_attr( $dribbble_url_instance ); ?>">
		</p>
		<!-- end: dribbble -->

		<!-- behance -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'behance_url' ) ); ?>"><?php esc_html_e( 'Behance URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'behance_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'behance_url' ) ); ?>" value="<?php echo esc_attr( $behance_url_instance ); ?>">
		</p>
		<!-- end: behance -->

		<!-- github -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'github_url' ) ); ?>"><?php esc_html_e( 'Github URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'github_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'github_url' ) ); ?>" value="<?php echo esc_attr( $github_url_instance ); ?>">
		</p>
		<!-- end: github -->

		<!-- stack overflow -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'stack_overflow_url' ) ); ?>"><?php esc_html_e( 'Stack Overflow URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'stack_overflow_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'stack_overflow_url' ) ); ?>" value="<?php echo esc_attr( $stack_overflow_url_instance ); ?>">
		</p>
		<!-- end: stack overflow -->

		<!-- slack -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'slack_url' ) ); ?>"><?php esc_html_e( 'Slack URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'slack_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'slack_url' ) ); ?>" value="<?php echo esc_attr( $slack_url_instance ); ?>">
		</p>
		<!-- end: slack -->

		<!-- mailchimp -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'mailchimp_url' ) ); ?>"><?php esc_html_e( 'Mailchimp URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'mailchimp_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'mailchimp_url' ) ); ?>" value="<?php echo esc_attr( $mailchimp_url_instance ); ?>">
		</p>
		<!-- end: mailchimp -->

		<!-- rss -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'rss_url' ) ); ?>"><?php esc_html_e( 'RSS URL:', 'halva-additional-features' ); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'rss_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rss_url' ) ); ?>" value="<?php echo esc_attr( $rss_url_instance ); ?>">
		</p>
		<!-- end: rss -->

		<?php
	}

	/**
	 * Processing widget options on save
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['twitter_url'] = sanitize_text_field( $new_instance['twitter_url'] );
		$instance['facebook_url'] = sanitize_text_field( $new_instance['facebook_url'] );
		$instance['pinterest_url'] = sanitize_text_field( $new_instance['pinterest_url'] );
		$instance['telegram_url'] = sanitize_text_field( $new_instance['telegram_url'] );
		$instance['reddit_url'] = sanitize_text_field( $new_instance['reddit_url'] );
		$instance['tiktok_url'] = sanitize_text_field( $new_instance['tiktok_url'] );
		$instance['discord_url'] = sanitize_text_field( $new_instance['discord_url'] );
		$instance['vk_url'] = sanitize_text_field( $new_instance['vk_url'] );
		$instance['odnoklassniki_url'] = sanitize_text_field( $new_instance['odnoklassniki_url'] );
		$instance['yandex_url'] = sanitize_text_field( $new_instance['yandex_url'] );
		$instance['linkedin_url'] = sanitize_text_field( $new_instance['linkedin_url'] );
		$instance['paypal_url'] = sanitize_text_field( $new_instance['paypal_url'] );
		$instance['patreon_url'] = sanitize_text_field( $new_instance['patreon_url'] );
		$instance['etsy_url'] = sanitize_text_field( $new_instance['etsy_url'] );
		$instance['amazon_url'] = sanitize_text_field( $new_instance['amazon_url'] );
		$instance['flickr_url'] = sanitize_text_field( $new_instance['flickr_url'] );
		$instance['instagram_url'] = sanitize_text_field( $new_instance['instagram_url'] );
		$instance['deviantart_url'] = sanitize_text_field( $new_instance['deviantart_url'] );
		$instance['youtube_url'] = sanitize_text_field( $new_instance['youtube_url'] );
		$instance['vimeo_url'] = sanitize_text_field( $new_instance['vimeo_url'] );
		$instance['twitch_url'] = sanitize_text_field( $new_instance['twitch_url'] );
		$instance['soundcloud_url'] = sanitize_text_field( $new_instance['soundcloud_url'] );
		$instance['spotify_url'] = sanitize_text_field( $new_instance['spotify_url'] );
		$instance['dribbble_url'] = sanitize_text_field( $new_instance['dribbble_url'] );
		$instance['behance_url'] = sanitize_text_field( $new_instance['behance_url'] );
		$instance['github_url'] = sanitize_text_field( $new_instance['github_url'] );
		$instance['stack_overflow_url'] = sanitize_text_field( $new_instance['stack_overflow_url'] );
		$instance['slack_url'] = sanitize_text_field( $new_instance['slack_url'] );
		$instance['mailchimp_url'] = sanitize_text_field( $new_instance['mailchimp_url'] );
		$instance['rss_url'] = sanitize_text_field( $new_instance['rss_url'] );

		return $instance;
	}

	/**
	 * Outputs the content of the widget
	 */
	public function widget( $args, $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Social links', 'halva-additional-features' );

		// get all URLs
		$social_url = array();
		$social_url['x-twitter'] = ! empty( $instance['twitter_url'] ) ? $instance['twitter_url'] : '';
		$social_url['facebook-f'] = ! empty( $instance['facebook_url'] ) ? $instance['facebook_url'] : '';
		$social_url['pinterest-p'] = ! empty( $instance['pinterest_url'] ) ? $instance['pinterest_url'] : '';
		$social_url['telegram-plane'] = ! empty( $instance['telegram_url'] ) ? $instance['telegram_url'] : '';
		$social_url['reddit-alien'] = ! empty( $instance['reddit_url'] ) ? $instance['reddit_url'] : '';
		$social_url['tiktok'] = ! empty( $instance['tiktok_url'] ) ? $instance['tiktok_url'] : '';
		$social_url['discord'] = ! empty( $instance['discord_url'] ) ? $instance['discord_url'] : '';
		$social_url['vk'] = ! empty( $instance['vk_url'] ) ? $instance['vk_url'] : '';
		$social_url['odnoklassniki'] = ! empty( $instance['odnoklassniki_url'] ) ? $instance['odnoklassniki_url'] : '';
		$social_url['yandex'] = ! empty( $instance['yandex_url'] ) ? $instance['yandex_url'] : '';
		$social_url['linkedin-in'] = ! empty( $instance['linkedin_url'] ) ? $instance['linkedin_url'] : '';
		$social_url['paypal'] = ! empty( $instance['paypal_url'] ) ? $instance['paypal_url'] : '';
		$social_url['patreon'] = ! empty( $instance['patreon_url'] ) ? $instance['patreon_url'] : '';
		$social_url['etsy'] = ! empty( $instance['etsy_url'] ) ? $instance['etsy_url'] : '';
		$social_url['amazon'] = ! empty( $instance['amazon_url'] ) ? $instance['amazon_url'] : '';
		$social_url['flickr'] = ! empty( $instance['flickr_url'] ) ? $instance['flickr_url'] : '';
		$social_url['instagram'] = ! empty( $instance['instagram_url'] ) ? $instance['instagram_url'] : '';
		$social_url['deviantart'] = ! empty( $instance['deviantart_url'] ) ? $instance['deviantart_url'] : '';
		$social_url['youtube'] = ! empty( $instance['youtube_url'] ) ? $instance['youtube_url'] : '';
		$social_url['vimeo-v'] = ! empty( $instance['vimeo_url'] ) ? $instance['vimeo_url'] : '';
		$social_url['twitch'] = ! empty( $instance['twitch_url'] ) ? $instance['twitch_url'] : '';
		$social_url['soundcloud'] = ! empty( $instance['soundcloud_url'] ) ? $instance['soundcloud_url'] : '';
		$social_url['spotify'] = ! empty( $instance['spotify_url'] ) ? $instance['spotify_url'] : '';
		$social_url['dribbble'] = ! empty( $instance['dribbble_url'] ) ? $instance['dribbble_url'] : '';
		$social_url['behance'] = ! empty( $instance['behance_url'] ) ? $instance['behance_url'] : '';
		$social_url['github'] = ! empty( $instance['github_url'] ) ? $instance['github_url'] : '';
		$social_url['stack-overflow'] = ! empty( $instance['stack_overflow_url'] ) ? $instance['stack_overflow_url'] : '';
		$social_url['slack'] = ! empty( $instance['slack_url'] ) ? $instance['slack_url'] : '';
		$social_url['mailchimp'] = ! empty( $instance['mailchimp_url'] ) ? $instance['mailchimp_url'] : '';
		$social_url['rss'] = ! empty( $instance['rss_url'] ) ? $instance['rss_url'] : '';

		// display "div" tag (before widget)
		echo wp_kses( $args['before_widget'], array(
			'div'	=> array(
				'id'	=> array(),
				'class'	=> array(),
			),
		) );

		// display widget title
		if ( $title ) {
			echo wp_kses( $args['before_title'], array(
				'h2'	=> array(
					'class'	=> array(),
				),
				'h3'	=> array(
					'class'	=> array(),
				),
			) );
			echo esc_html( $title );
			echo wp_kses( $args['after_title'], array(
				'h2'	=> array(),
				'h3'	=> array(),
			) );
		}

		// check $social_url
		$social_url_empty = true;
		foreach ( $social_url as $social_url_value ) {
			if ( $social_url_value ) {
				$social_url_empty = false;
				break;
			}
		}

		// show social links
		if ( ! $social_url_empty ) {
			?>
			<ul class="list-unstyled clearfix">
				<?php
				foreach ( $social_url as $social_url_key => $social_url_value ) {
					if ( $social_url_value ) {
						if ( 'rss' !== $social_url_key ) {
							?>
							<li>
								<a href="<?php echo esc_url( $social_url_value ); ?>" target="_blank" rel="noopener noreferrer" class="widget_bwp_social_link widget_bwp_social_link_<?php echo esc_attr( $social_url_key ); ?>">
									<i class="fa-brands fa-<?php echo esc_attr( $social_url_key ); ?>"></i>
								</a>
							</li>
							<?php
						} else {
							?>
							<li>
								<a href="<?php echo esc_url( $social_url_value ); ?>" target="_blank" rel="noopener noreferrer" class="widget_bwp_social_link widget_bwp_social_link_rss">
									<i class="fa-solid fa-rss"></i>
								</a>
							</li>
							<?php
						}
					}
				}
				?>
			</ul>
			<?php
		} else {
			?>
			<p class="widget_bwp_no_social_links">
				<?php esc_html_e( 'There are no social links.', 'halva-additional-features' ); ?>
			</p>
			<?php
		}

		// display "div" tag (after widget)
		echo wp_kses( $args['after_widget'], array( 'div' => array() ) );
	}

}
