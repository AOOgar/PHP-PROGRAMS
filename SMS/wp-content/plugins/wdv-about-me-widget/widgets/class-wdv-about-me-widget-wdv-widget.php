<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://wdvillage.com
 * @since      1.0.0
 *
 * @package    Wdv_About_Me_Widget
 * @subpackage Wdv_About_Me_Widget/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wdv_About_Me_Widget
 * @subpackage Wdv_About_Me_Widget/includes
 * @author     wdvillage <wdvillage100@gmail.com>
 */
class Wdv_About_Me_Widget_Wdv_Widget extends WP_Widget {

    /**
     * @var array $icons
     * Collection of icon from fontawesome
     */
    private $icons = array(
        array(
            'icon' => 'Behance',
            'icon-name' => 'behance',
            'icon-i' => '<i class="fab fa-behance"></i>',
            'icon-code' => 'f1b4',
        ),        
        array(
            'icon' => 'Blogger',
            'icon-name' => 'blogger-b',
            'icon-i' => '<i class="fab fa-blogger-b"></i>',
            'icon-code' => 'f37d',
        ),        
        array(
            'icon' => 'Codepen',
            'icon-name' => 'codepen',            
            'icon-i' => '<i class="fab fa-codepen"></i>',
            'icon-code' => 'f1cb',
        ),               
        array(
            'icon' => 'Deviantart',
            'icon-name' => 'deviantart',            
            'icon-i' => '<i class="fab fa-deviantart"></i>',
            'icon-code' => 'f1bd',
        ),                   
        array(
            'icon' => 'Dribbble',
            'icon-name' => 'dribbble',            
            'icon-i' => '<i class="fab fa-dribbble"></i>',
            'icon-code' => 'f17d',
        ),                           
        array(
            'icon' => 'Facebook',
            'icon-name' => 'facebook-f',            
            'icon-i' => '<i class="fab fa-facebook-f"></i>',
            'icon-code' => 'f39e',
        ),        
        array(
            'icon' => 'Flickr',
            'icon-name' => 'flickr',            
            'icon-i' => '<i class="fab fa-flickr"></i>',
            'icon-code' => 'f16e',
        ),                
        array(
            'icon' => 'Foursquare',
            'icon-name' => 'foursquare',            
            'icon-i' => '<i class="fab fa-foursquare"></i>',
            'icon-code' => 'f180',
        ),                 
        array(
            'icon' => 'Github',
            'icon-name' => 'github',            
            'icon-i' => '<i class="fab fa-github"></i>',
            'icon-code' => 'f09b',
        ),                   
        array(
            'icon' => 'Gitlab',
            'icon-name' => 'gitlab',            
            'icon-i' => '<i class="fab fa-gitlab"></i>',
            'icon-code' => 'f296',
        ), 
        array(
            'icon' => 'Instagram',
            'icon-name' => 'instagram',            
            'icon-i' => '<i class="fab fa-instagram"></i>',
            'icon-code' => 'f16d',
        ), 
        array(
            'icon' => 'Linkedin',
            'icon-name' => 'linkedin-in',            
            'icon-i' => '<i class="fab fa-linkedin-in"></i>',
            'icon-code' => 'f0e1',
        ),        
        array(
            'icon' => 'Medium',
            'icon-name' => 'medium-m',            
            'icon-i' => '<i class="fab fa-medium-m"></i>',
            'icon-code' => 'f3c7',
        ),         
        array(
            'icon' => 'Meetup',
            'icon-name' => 'meetup',            
            'icon-i' => '<i class="fab fa-meetup"></i>',
            'icon-code' => 'f2e0',
        ),   
        array(
            'icon' => 'Odnoklassniki',
            'icon-name' => 'odnoklassniki',            
            'icon-i' => '<i class="fab fa-odnoklassniki"></i>',
            'icon-code' => 'f263',
        ),        
        array(
            'icon' => 'Periscope',
            'icon-name' => 'periscope',            
            'icon-i' => '<i class="fab fa-periscope"></i>',
            'icon-code' => 'f3da',
        ),         
        array(
            'icon' => 'Pinterest',
            'icon-name' => 'pinterest-p',            
            'icon-i' => '<i class="fab fa-pinterest-p"></i>',
            'icon-code' => 'f231',
        ),        
        array(
            'icon' => 'Pocket',
            'icon-name' => 'get-pocket',            
            'icon-i' => '<i class="fab fa-get-pocket"></i>',
            'icon-code' => 'f265',
        ),        
        array(
            'icon' => 'Qq',
            'icon-name' => 'qq',            
            'icon-i' => '<i class="fab fa-qq"></i>',
            'icon-code' => 'f1d6',
        ),  
        array(
            'icon' => 'Reddit',
            'icon-name' => 'reddit-alien',            
            'icon-i' => '<i class="fab fa-reddit-alien"></i>',
            'icon-code' => 'f281',
        ),       
        array(
            'icon' => 'Stumbleupon',
            'icon-name' => 'stumbleupon',            
            'icon-i' => '<i class="fab fa-stumbleupon"></i>',
            'icon-code' => 'f1a4',
        ),              
        array(
            'icon' => 'Slack',
            'icon-name' => 'slack',            
            'icon-i' => '<i class="fab fa-slack"></i>',
            'icon-code' => 'f198',
        ),              
        array(
            'icon' => 'Snapchat',
            'icon-name' => 'snapchat-ghost',
            'icon-i' => '<i class="fab fa-snapchat-ghost"></i>',
            'icon-code' => 'f2ac',
        ),              
        array(
            'icon' => 'Soundcloud',
            'icon-name' => 'soundcloud',
            'icon-i' => '<i class="fab fa-soundcloud"></i>',
            'icon-code' => 'f1be',
        ),                         
        array(
            'icon' => 'Spotify',
            'icon-name' => 'spotify',
            'icon-i' => '<i class="fab fa-spotify"></i>',
            'icon-code' => 'f1bc',
        ),                         
        array(
            'icon' => 'Stackoverflow',
            'icon-name' => 'stack-overflow',
            'icon-i' => '<i class="fab fa-stack-overflow"></i>',
            'icon-code' => 'f16c',
        ),                       
        array(
            'icon' => 'Telegram',
            'icon-name' => 'telegram-plane',
            'icon-i' => '<i class="fab fa-telegram-plane"></i>',
            'icon-code' => 'f3fe',
        ),                     
        array(
            'icon' => 'Tripadvisor',
            'icon-name' => 'tripadvisor',
            'icon-i' => '<i class="fab fa-tripadvisor"></i>',
            'icon-code' => 'f262',
        ),                      
        array(
            'icon' => 'Tumblr',
            'icon-name' => 'tumblr',
            'icon-i' => '<i class="fab fa-tumblr"></i>',
            'icon-code' => 'f173',
        ),                
        array(
            'icon' => 'Twitch',
            'icon-name' => 'twitch',
            'icon-i' => '<i class="fab fa-twitch"></i>',
            'icon-code' => 'f1e8',
        ),  
        array(
            'icon' => 'Twitter',
            'icon-name' => 'twitter',
            'icon-i' => '<i class="fab fa-twitter"></i>',
            'icon-code' => 'f099',
        ),        
        array(
            'icon' => 'Viadeo',
            'icon-name' => 'viadeo',
            'icon-i' => '<i class="fab fa-viadeo"></i>',
            'icon-code' => 'f2a9',
        ),              
        array(
            'icon' => 'Vimeo',
            'icon-name' => 'vimeo-v',
            'icon-i' => '<i class="fab fa-vimeo-v"></i>',
            'icon-code' => 'f27d',
        ),                    
        array(
            'icon' => 'Vine',
            'icon-name' => 'vine',
            'icon-i' => '<i class="fab fa-vine"></i>',
            'icon-code' => 'f1ca',
        ),         
        array(
            'icon' => 'Vk',
            'icon-name' => 'vk',
            'icon-i' => '<i class="fab fa-vk"></i>',
            'icon-code' => 'f189',
        ),                
        array(
            'icon' => 'Weibo',
            'icon-name' => 'weibo',
            'icon-i' => '<i class="fab fa-weibo"></i>',
            'icon-code' => 'f18a',
        ),                    
        array(
            'icon' => 'Wechat',
            'icon-name' => 'wechat',
            'icon-i' => '<i class="fab fa-weixin"></i>',
            'icon-code' => 'f1d7',
        ),          
        array(
            'icon' => 'Wordpress',
            'icon-name' => 'wordpress-simple',
            'icon-i' => '<i class="fab fa-wordpress-simple"></i>',
            'icon-code' => 'f411',
        ),               
        array(
            'icon' => 'Xing',
            'icon-name' => 'xing',
            'icon-i' => '<i class="fab fa-xing"></i>',
            'icon-code' => 'f168',
        ),               
        array(
            'icon' => 'Yelp',
            'icon-name' => 'yelp',
            'icon-i' => '<i class="fab fa-yelp"></i>',
            'icon-code' => 'f1e9',
        ),                        
        array(
            'icon' => 'Youtube',
            'icon-name' => 'youtube',
            'icon-i' => '<i class="fab fa-youtube"></i>',
            'icon-code' => 'f167',
        ),                    
        array(
            'icon' => 'Yoast',
            'icon-name' => 'yoast',
            'icon-i' => '<i class="fab fa-yoast"></i>',
            'icon-code' => 'f2b1',
        ),                    
    );

    public function __construct() {
        $this->defaults = array(
            'title' => '',
            'image' => '',
            'name' => '',
            'profession' => '',
            'description' => '',
            'img-width' => 200,
            'img-height' => 150,
            'img-radius' => 10,
            'align' => 'center',
            'link-text' => '',
            'link-address' => '',
			'link-align' => 'right',
            'text_new_tab' => 'on',
            
            'contact-icon-color'=> '#333',
            'contact-text'=> 'Contacts:',
            'contact-address'=> '',  
            'contact-phone'=> '', 
            'contact-email'=> '', 
            'contact-skype'=> '', 
            'contact-whatsapp'=> '', 
            'contact-viber'=> '', 
            
            'background' => 'yes',
            'icon-font-size' => 16,
            'icon-padding' => 8,
            'icon-border-radius' => 0,
            'icon-color' => '#333',
            'icon-bg-color' => '#eee',
            'icon-hover-color' => '#ccc',

            'iconBehance' => '',
            'iconBlogger' => '',
            'iconCodepen' => '',
            'iconDeviantart' => '',
            'iconDribbble' => '',
            'iconFacebook' => '',
            'iconFlickr' => '',
            'iconFoursquare' => '',
            'iconGithub' => '',
            'iconGitlab' => '',
            'iconInstagram' => '',
            'iconLinkedin' => '',
            'iconMedium' => '',
            'iconMeetup' => '',
            'iconOdnoklassniki' => '',
            'iconPeriscope' => '',
            'iconPinterest' => '',
            'iconPocket' => '',
            'iconQq' => '',
            'iconReddit' => '',
            'iconStumbleupon' => '',
            'iconSlack' => '',
            'iconSnapchat' => '',
            'iconSoundcloud' => '',
            'iconSpotify' => '',
            'iconStackoverflow' => '',
            'iconTelegram' => '',
            'iconTripadvisor' => '',
            'iconTumblr' => '',
            'iconTwitch' => '',
            'iconTwitter' => '',
            'iconViadeo' => '',
            'iconVimeo' => '',
            'iconVine' => '',
            'iconVk' => '',
            'iconWeibo' => '',
            'iconWechat' => '',
            'iconWordpress' => '',
            'iconXing' => '',
            'iconYelp' => '',
            'iconYoutube' => '',
            'iconYoast' => '',                                

        );

        $widget_ops = array('classname' => 'wdv_about_me_widget_wdv_widget', 'description' => __('Tell more about yourself or about your firm', 'wdv-about-me-widget'));
        parent::__construct('wdv_about_me', __('WDV About Me Widget', 'wdv-about-me-widget'), $widget_ops);
    }

    //frontend output content
    public function widget($args, $instance) {
        $instance = wp_parse_args((array) $instance, $this->defaults);

        echo $args['before_widget'];
		
        echo '<!--begin class="wdv-container"--><div class="wdv-container">';
        if (!empty($instance['title']))
            echo $args['before_title'] . apply_filters('widget_title', $instance['title'], $instance, $this->id_base) . $args['after_title'];

        if ($instance['align'] === 'center') {
            $align = 'center;'; ?>
            <style>
                .wdv-container .contact-container {padding-left: 2em; padding-right: 2em;}
            </style>
        <?php               
        } else {
            $align = 'left;'; ?>
            <style>
                .wdv-container .contact-container {padding-left: 0; padding-right: 0;}
            </style>            
            <?php
        }        
        

        if ($instance['link-align'] === 'right') {
            $linkalign = 'right;'; ?>
            <style>
                .wdv-header a .about-link {text-align: right;}
            </style>
        <?php               
        } elseif ($instance['link-align'] === 'left') {
            $linkalign = 'left;'; ?>
            <style>
                .wdv-header a .about-link {text-align: left;}
            </style>            
            <?php
        } else{
            $linkalign = 'center;'; ?>
            <style>
                .wdv-header a .about-link{text-align: center;}
            </style>            
            <?php
        } 


        if ($instance['text_new_tab'] === 'on') {
            echo (!empty($instance['link-address']) ) ? '<a href="' . esc_url($instance['link-address']) . '" target="_blank">' : '';
        } else {
            echo (!empty($instance['link-address']) ) ? '<a href="' . esc_url($instance['link-address']) . '" target="_self">' : '';
        }
        echo (!empty($instance['image']) ) ? '<div class="wdv-image" style="background-image:url(' . esc_url($instance['image']) . ');'
                . 'width:' . $instance['img-width'] . 'px;'
                . 'height: ' . $instance['img-height'] . 'px;'
                . 'border-radius: ' . $instance['img-radius'] . 'px;'
                . 'margin:0 auto;' . '"></div>' : '';

        echo (!empty($instance['link-address']) ) ? '</a>' : '';
		
        echo '<!--begin class="wdv-header"--><div class="wdv-header">';
        echo (!empty($instance['name']) ) ? '<div class="wdv-about-name" style="text-align:' . esc_html($instance['align']) . ';">' . esc_html($instance['name']) . '</div>' : '';
        echo (!empty($instance['profession']) ) ? '<div class="wdv-about-profession" style="text-align:' . esc_html($instance['align']) . ';">' . esc_html($instance['profession']) . '</div>' : '';
        echo (!empty($instance['description']) ) ? '<div class="about-description">' . esc_html($instance['description']) . '</div>' : '';

        if ($instance['text_new_tab'] === 'on') {
            echo (!empty($instance['link-address']) ) ? '<a href="' . esc_url($instance['link-address']) . '" target="_blank"><div class="about-link">' . esc_html($instance['link-text']) . '</div></a>' : '';
        } else {
            echo (!empty($instance['link-address']) ) ? '<a href="' . esc_url($instance['link-address']) . '" target="_self"><div class="about-link">' . esc_html($instance['link-text']) . '</div></a>' : '';
        }			
		echo '</div><!--end class="wdv-header"-->';

        if( !empty($instance['contact-address'])||!empty($instance['contact-phone'])||!empty($instance['contact-email'])||!empty($instance['contact-skype'])||!empty($instance['contact-whatsapp'])||!empty($instance['contact-viber']))  {
            echo '<!--begin class="contact-information"--><div class="contact-information">';
                if( $instance['contact-text'])  {
			echo '<div class="contact-text" style="text-align:' . esc_html($instance['align']) . ';">';
			echo esc_html($instance['contact-text']);                            
			echo '</div>';
		}              
        }
 
    if( !empty($instance['contact-address'])||!empty($instance['contact-phone'])||!empty($instance['contact-email'])||!empty($instance['contact-skype'])||!empty($instance['contact-whatsapp'])||!empty($instance['contact-viber']))  {
            echo '<!--begin class="contact-container"--><div class="contact-container">';
        }            
        if( $instance['contact-address'])  {
			echo '<div class="contact-address"><i class="fas fa-map-marker-alt" style="color:' . esc_html($instance['contact-icon-color']) . ';"></i>' . esc_html($instance['contact-address']) . '</div>';                            
		}
	if( $instance['contact-phone'] ) {
                        echo '<div class="contact-phone"><i class="fas fa-phone-alt" style="color:' . esc_html($instance['contact-icon-color']) . ';"></i>'. esc_html($instance['contact-phone']) .'</div>';
        }
	if( $instance['contact-email'] ) {
			echo '<div class="contact-email"><i class="far fa-envelope" style="color:' . esc_html($instance['contact-icon-color']) . ';"></i>' . '<a href="mailto:' . esc_attr($instance['contact-email']) . '">' . esc_html($instance['contact-email']) . '</a></div>';
		}        
        if( $instance['contact-skype'] ) {
                        echo '<div class="contact-skype"><i class="fab fa-skype" style="color:' . esc_html($instance['contact-icon-color']) . ';"></i>'. esc_html($instance['contact-skype']) .'</div>';
        }
	if( $instance['contact-whatsapp'] ) {
                        echo '<div class="contact-whatsapp"><i class="fab fa-whatsapp" style="color:' . esc_html($instance['contact-icon-color']) . ';"></i>'. esc_html($instance['contact-whatsapp']) .'</div>';
        }
	if( $instance['contact-viber'] ) {
                        echo '<div class="contact-viber"><i class="fab fa-viber" style="color:' . esc_html($instance['contact-icon-color']) . ';"></i>'. esc_html($instance['contact-viber']) .'</div>';
        } 
        if( !empty($instance['contact-address'])||!empty($instance['contact-phone'])||!empty($instance['contact-email'])||!empty($instance['contact-skype'])||!empty($instance['contact-whatsapp'])||!empty($instance['contact-viber']))  {
            echo '</div>';
        } 	
		if( $instance['contact-address']||$instance['contact-phone']||$instance['contact-email']||$instance['contact-skype']||$instance['contact-whatsapp']||$instance['contact-viber'])  {
            echo '</div><!--end class="contact-container"-->';
        } 
        ?>
		 	       
        <?php echo '<!--begin class="wdv-icon-container" --><div class="wdv-icon-container">';
        $publicicons = $this->icons;
        for ($i = 0; $i < count($publicicons); $i++) {
               $name='icon'.$publicicons[$i]['icon'];
               $hovercolor="'".esc_html($instance["icon-hover-color"])."'";
               $color="'".esc_html($instance["icon-color"])."'";
               
               if ($instance['background']==='no') {
                   $icon_color = esc_html($instance['icon-color']);
                   $icon_bg_color='transparent';
               } else {
                   $icon_color = esc_html($instance['icon-color']);
                   $icon_bg_color=esc_html($instance['icon-bg-color']);
               }
               
               echo (!empty($instance[$name]) ) ? '<a target="_blank" href="' . esc_url($instance[$name]) . '">'
                       . '<i class="fab fa-'.$publicicons[$i]["icon-name"].'"  '
                       . 'style="'
                       . 'font-size:'.esc_html($instance["icon-font-size"])."px" . "; "
                       . 'min-width:'.((int)$instance['icon-padding']*2+(int)$instance['icon-font-size']).'px; '
                       . 'padding:'. esc_html($instance['icon-padding']).'px' . '; '
                       . 'border-radius:'. esc_html($instance['icon-border-radius']).'px' . '; '
                       . 'color:'.$icon_color . '; '                     
                       . 'background:'.$icon_bg_color . '; '
                       . '"'
                       . ' onmouseover = "this.style.color='.$hovercolor.';" onmouseout = "this.style.color='.$color.';"></i>' : '';
        }
        echo '</a></div><!--end class="wdv-icon-container"-->';

		echo '</div><!--end class="wdv-container"-->';
		
        echo $args['after_widget'];           
    }
    //backend form
    public function form($instance) {
        $instance = wp_parse_args((array) $instance, $this->defaults);
        ?>
        <!---------------------------->
        <!--Add btn "Buy PRO Version" -->
        <!---------------------------->
        <p>
            <a href="https://wdvillage.com/product/wdv-about-me-widget-pro" target="_blank" class="button button-primary">
                <?php _e('Get PRO Version', 'wdv-about-me-widget' ); ?> 
            </a>
        </p>
        <!---------------------------->
        <!--Add title -->
        <!---------------------------->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'wdv-about-me-widget'); ?>:</label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
        </p><br>
        <!---------------------------->
        <!--Add Image -->  
        <!---------------------------->
        <div class="wdv-image-container">        

            <label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php esc_html_e('Image', 'wdv-about-me-widget'); ?>:</label><br>
            <div class="wdv-media-container" >

                <div class="wdv-media-inner">
                    <?php $img_style = ( $instance['image'] != '' ) ? '' : 'style="display:none; float: left"'; 
                    if ($instance['image']) {?>
                    <style>
                        .wdv-media-inner .no-image {display: none;}
                    </style>                        
                    <?php } ?>
                    
                    <img id="<?php echo esc_attr($this->get_field_id('image')); ?>-preview" src="<?php echo esc_url($instance['image']); ?>" <?php echo esc_attr($img_style); ?> <?php $no_img_style = esc_attr(( $instance['image'] != '' ) ? 'style="display:none"' : ''); ?> /><br>        
                    <span class="no-image" id="<?php echo esc_attr($this->get_field_id('image')); ?>-noimg" <?php echo esc_attr($no_img_style); ?>><?php esc_html_e('No image selected', 'wdv-about-me-widget'); ?></span><br><br>
                    <div class="wdv-empty"></div>
                </div>

                <input type="text" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('image')); ?>" value="<?php echo esc_attr($instance['image']); ?>" class="wdv-media-url" />
                <p>
                    <input type="button" value="<?php echo esc_html_e('Remove Image', 'wdv-about-me-widget'); ?>" class="button wdv-media-remove" id="<?php echo esc_attr($this->get_field_id('image')); ?>-remove" <?php echo esc_attr($img_style); ?> />
                    <input type="button" value="<?php echo esc_html_e('Select Image', 'wdv-about-me-widget'); ?>" class="button wdv-media-upload" id="<?php echo esc_attr($this->get_field_id('image')); ?>-button" />
                </p>
            </div>

        </div> 
        
        <p><br>       

        <!---------------------------->
        <!--Image size and border radius--> 
        <!---------------------------->
        <p>
 
             <label for="<?php echo $this->get_field_id('text_area'); ?>">
                <?php echo('IMAGE SETTINGS'); ?>
            </label><br>

            <label for="<?php echo esc_attr($this->get_field_id('img-width')); ?>"><?php esc_html_e('Image width (px)', 'wdv-about-me-widget'); ?>:</label>
            <input class="widefat" type="number" min="20" max="500" step="5" id="<?php echo esc_attr($this->get_field_id('img-width')); ?>" name="<?php echo esc_attr($this->get_field_name('img-width')); ?>" value="<?php echo esc_attr($instance['img-width']); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('img-height')); ?>"><?php esc_html_e('Image height (px)', 'wdv-about-me-widget'); ?>:</label>
            <input class="widefat" type="number" min="20" max="500" step="5" id="<?php echo esc_attr($this->get_field_id('img-height')); ?>" name="<?php echo esc_attr($this->get_field_name('img-height')); ?>" value="<?php echo esc_attr($instance['img-height']); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('img-radius')); ?>"><?php esc_html_e('Border radius for image (px)', 'wdv-about-me-widget'); ?>:</label>
            <input class="widefat" type="number" min="0" max="500" step="1" id="<?php echo esc_attr($this->get_field_id('img-radius')); ?>" name="<?php echo esc_attr($this->get_field_name('img-radius')); ?>" value="<?php echo esc_attr($instance['img-radius']); ?>" />
        </p><br>

        <!---------------------------->
            <!--Image and text align--> 
            <!---------------------------->
            <label for="<?php echo $this->get_field_id('text_area'); ?>">
                <?php echo('TEXT ALIGH'); ?>
            </label><br>
            <?php
            $rate = isset($instance['align']) ? $instance['align'] : 'center';

            echo '<p>';
            $value = 'left';

            echo '<input value="' . $value . '" class="widefat" id="' . $this->get_field_id($value) . '" name="' . $this->get_field_name('align') . '" type="radio"' . ($rate == $value ? ' checked="checked"' : '') . ' />';
            echo '<label for="' . $this->get_field_id($value) . '">' . __('left', 'wdv-about-me-widget') . '</label>';
            echo '<br/>';

            /* Default value */
            $value = 'center';

            echo '<input value="' . $value . '" class="widefat" id="' . $this->get_field_id($value) . '" name="' . $this->get_field_name('align') . '" type="radio"' . ($rate == $value ? ' checked="checked"' : '') . ' />';
            echo '<label for="' . $this->get_field_id($value) . '">' . __('center', 'wdv-about-me-widget') . '</label>';

            echo '</p>';
            ?>    

        </p><br> 
        <!---------------------------->
        <!--Info--> 
        <!---------------------------->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('name')); ?>"><?php esc_html_e('Your name or company name', 'wdv-about-me-widget'); ?>:</label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('name')); ?>" name="<?php echo esc_attr($this->get_field_name('name')); ?>" value="<?php echo esc_attr($instance['name']); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('profession')); ?>"><?php esc_html_e('Profession', 'wdv-about-me-widget'); ?>:</label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('profession')); ?>" name="<?php echo esc_attr($this->get_field_name('profession')); ?>" value="<?php echo esc_attr($instance['profession']); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('description')); ?>"><?php esc_html_e(__('Description:', 'wdv-about-me-widget')); ?></label>
            <textarea class="widefat" rows="6" cols="20" id="<?php echo esc_attr($this->get_field_id('description')); ?>" name="<?php echo esc_attr($this->get_field_name('description')); ?>" type="text" ><?php echo esc_attr($instance['description']); ?></textarea>
        </p><br> 
        <!---------------------------->
        <!--Link--> 
        <!---------------------------->
        <label for="<?php echo $this->get_field_id('text_link'); ?>">
            <?php echo('TEXT LINK:'); ?>
        </label><br> 
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('link-text')); ?>"><?php esc_html_e(__('Link text:', 'wdv-about-me-widget')); ?></label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('link-text')); ?>" name="<?php echo esc_attr($this->get_field_name('link-text')); ?>" value="<?php echo esc_attr($instance['link-text']); ?>" />
        </p> 

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('link-address')); ?>"><?php esc_html_e(__('Link address:', 'wdv-about-me-widget')); ?></label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('link-address')); ?>" name="<?php echo esc_attr($this->get_field_name('link-address')); ?>" value="<?php echo esc_attr($instance['link-address']); ?>" />
        </p> 


        <p>
            <!---------------------------->
            <!--Link align--> 
            <!---------------------------->
            <label for="<?php echo $this->get_field_id('text_area'); ?>">
                <?php echo('Link align'); ?>
            </label><br>
            <?php
            $rate = isset($instance['link-align']) ? $instance['link-align'] : 'right';

            echo '<p>';
            /* Default value */
            $value = 'right';

            echo '<input value="' . $value . '" class="widefat" id="' . $this->get_field_id($value) . '" name="' . $this->get_field_name('link-align') . '" type="radio"' . ($rate == $value ? ' checked="checked"' : '') . ' />';
            echo '<label for="' . $this->get_field_id($value) . '">' . __('right', 'wdv-about-me-widget') . '</label>';
            echo '<br/>';

            $value = 'center';

            echo '<input value="' . $value . '" class="widefat" id="' . $this->get_field_id($value) . '" name="' . $this->get_field_name('link-align') . '" type="radio"' . ($rate == $value ? ' checked="checked"' : '') . ' />';
            echo '<label for="' . $this->get_field_id($value) . '">' . __('center', 'wdv-about-me-widget') . '</label>';
            echo '<br/>';

            $value = 'left';

            echo '<input value="' . $value . '" class="widefat" id="' . $this->get_field_id($value) . '" name="' . $this->get_field_name('link-align') . '" type="radio"' . ($rate == $value ? ' checked="checked"' : '') . ' />';
            echo '<label for="' . $this->get_field_id($value) . '">' . __('left', 'wdv-about-me-widget') . '</label>';
            echo '<br/>';

            echo '</p>';
            ?>    

        </p>        

        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['text_new_tab'], 'on'); ?> id="<?php echo $this->get_field_id('text_new_tab'); ?>" name="<?php echo $this->get_field_name('text_new_tab'); ?>"/>
            <label for="<?php echo $this->get_field_id('text_new_tab'); ?>"><?php _e('Open text links in new tab? ', 'wdv-about-me-widget'); ?></label>
        </p><br>  
        
        <!---------------------------->
        <!--Contact info--> 
        <!---------------------------->
        <label for="<?php echo $this->get_field_id('text_area'); ?>">
            <?php echo('CONTACT INFORMATIONS:'); ?>
        </label><br>      
        <div class="wdv-contact-info">            
            
        <!---------------------------->
        <!--Contact icon's color--> 
        <!---------------------------->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('contact-icon-color')); ?>"><?php _e('Contact icons color:', 'wdv-about-me-widget'); ?></label> 
            <input id="contact-icon-color-field" id="<?php echo esc_attr($this->get_field_id('contact-icon-color')); ?>" name="<?php echo esc_attr($this->get_field_name('contact-icon-color')); ?>" type="text" value="<?php echo esc_attr($instance['contact-icon-color']); ?>" />    
        </p>        
                       
            
        <div class="contact-input">
            <label for="<?php echo esc_attr($this->get_field_id('contact-text')); ?>"><?php esc_html_e("Contact's title", 'wdv-about-me-widget'); ?>:</label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('contact-text')); ?>" name="<?php echo esc_attr($this->get_field_name('contact-text')); ?>" value="<?php echo esc_attr($instance['contact-text']); ?>" />
        </div>            
        
        <div class="contact-input">
            <label for="<?php echo esc_attr($this->get_field_id('contact-address')); ?>"><?php esc_html_e('Address', 'wdv-about-me-widget'); ?>:</label>
            <div class="icon-i"><i class="fas fa-map-marker-alt"></i></div>
            <div class="inline"><input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('contact-address')); ?>" name="<?php echo esc_attr($this->get_field_name('contact-address')); ?>" value="<?php echo esc_attr($instance['contact-address']); ?>" /></div>
        </div>    

        <div class="contact-input">
            <label for="<?php echo esc_attr($this->get_field_id('contact-phone')); ?>"><?php esc_html_e('Telephone number', 'wdv-about-me-widget'); ?>:</label>
            <div class="icon-i"><i class="fas fa-phone-alt"></i></div>
            <div class="inline"><input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('contact-phone')); ?>" name="<?php echo esc_attr($this->get_field_name('contact-phone')); ?>" value="<?php echo esc_attr($instance['contact-phone']); ?>" /></div>
        </div> 
        
        <div class="contact-input">
            <label for="<?php echo esc_attr($this->get_field_id('contact-email')); ?>"><?php esc_html_e('E-mail', 'wdv-about-me-widget'); ?>:</label>
            <div class="icon-i"><i class="far fa-envelope"></i></div>
            <div class="inline"><input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('contact-email')); ?>" name="<?php echo esc_attr($this->get_field_name('contact-email')); ?>" value="<?php echo esc_attr($instance['contact-email']); ?>" /></div>
        </div> 
        
        <div class="contact-input">
            <label for="<?php echo esc_attr($this->get_field_id('contact-skype')); ?>"><?php esc_html_e('Skype', 'wdv-about-me-widget'); ?>:</label>
            <div class="icon-i"><i class="fab fa-skype"></i></div>
            <div class="inline"><input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('contact-skype')); ?>" name="<?php echo esc_attr($this->get_field_name('contact-skype')); ?>" value="<?php echo esc_attr($instance['contact-skype']); ?>" /></div>
        </div> 
        
        <div class="contact-input">
            <label for="<?php echo esc_attr($this->get_field_id('contact-whatsapp')); ?>"><?php esc_html_e('WhatsApp', 'wdv-about-me-widget'); ?>:</label>
            <div class="icon-i"><i class="fab fa-whatsapp"></i></div>
            <div class="inline"><input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('contact-whatsapp')); ?>" name="<?php echo esc_attr($this->get_field_name('contact-whatsapp')); ?>" value="<?php echo esc_attr($instance['contact-whatsapp']); ?>" /></div>
        </div> 
        
        <div class="contact-input">
            <label for="<?php echo esc_attr($this->get_field_id('contact-viber')); ?>"><?php esc_html_e('Viber', 'wdv-about-me-widget'); ?>:</label>
            <div class="icon-i"><i class="fab fa-viber"></i></div>
            <div class="inline"><input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('contact-viber')); ?>" name="<?php echo esc_attr($this->get_field_name('contact-viber')); ?>" value="<?php echo esc_attr($instance['contact-viber']); ?>" /></div>
        </div> 
        </div>
        <br>
        <!---------------------------->
        <!--Social icons--> 
        <!---------------------------->
        <!---------------------------->
        <!--Icon style--> 
        <!---------------------------->
        <label for="<?php echo $this->get_field_id('text_area'); ?>">
            <?php echo('SOCIAL ICONS:'); ?>
        </label><br>      

        <label for="<?php echo $this->get_field_id('text_area'); ?>">
            <?php echo('Icon style:'); ?>
        </label><br>   
        <?php
        $rate = isset($instance['background']) ? $instance['background'] : 'yes';

        echo '<p>';
        $value = 'no';

        echo '<input value="' . $value . '" class="widefat" id="' . $this->get_field_id($value) . '" name="' . $this->get_field_name('background') . '" type="radio"' . ($rate == $value ? ' checked="checked"' : '') . ' />';
        echo '<label for="' . $this->get_field_id($value) . '">' . __('Icon color (Icon have no background)', 'wdv-about-me-widget') . '</label>';
        echo '<br/>';

        /* Default value */
        $value = 'yes';

        echo '<input value="' . $value . '" class="widefat" id="' . $this->get_field_id($value) . '" name="' . $this->get_field_name('background') . '" type="radio"' . ($rate == $value ? ' checked="checked"' : '') . ' />';
        echo '<label for="' . $this->get_field_id($value) . '">' . __('Icon background color', 'wdv-about-me-widget') . '</label>';

        echo '</p>';
        ?>       

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('icon-font-size')); ?>"><?php esc_html_e(__('Icon font size:', 'wdv-about-me-widget')); ?></label>
            <input class="widefat" type="number" min="5" max="50" step="1" id="<?php echo esc_attr($this->get_field_id('icon-font-size')); ?>" name="<?php echo esc_attr($this->get_field_name('icon-font-size')); ?>" value="<?php echo esc_attr($instance['icon-font-size']); ?>" />
        </p> 

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('icon-padding')); ?>"><?php esc_html_e(__('Icon padding:', 'wdv-about-me-widget')); ?></label>
            <input class="widefat" type="number" min="1" max="50" step="1" id="<?php echo esc_attr($this->get_field_id('icon-padding')); ?>" name="<?php echo esc_attr($this->get_field_name('icon-padding')); ?>" value="<?php echo esc_attr($instance['icon-padding']); ?>" />
        </p> 

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('icon-border-radius')); ?>"><?php esc_html_e(__('Icon border radius:', 'wdv-about-me-widget')); ?></label>
            <input class="widefat" type="number" min="0" max="50" step="1" id="<?php echo esc_attr($this->get_field_id('icon-border-radius')); ?>" name="<?php echo esc_attr($this->get_field_name('icon-border-radius')); ?>" value="<?php echo esc_attr($instance['icon-border-radius']); ?>" />
        </p>         
        <!---------------------------->
        <!--Icon color--> 
        <!---------------------------->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('icon-color')); ?>"><?php _e('Icon color:', 'wdv-about-me-widget'); ?></label><br> 
            <input id="icon-color-field" id="<?php echo esc_attr($this->get_field_id('icon-color')); ?>" name="<?php echo esc_attr($this->get_field_name('icon-color')); ?>" type="text" value="<?php echo esc_attr($instance['icon-color']); ?>" />    
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('icon-bg-color')); ?>"><?php _e("Icon background color:", 'wdv-about-me-widget'); ?></label><br> 
            <input id="icon-bg-color-field" id="<?php echo esc_attr($this->get_field_id('icon-bg-color')); ?>" name="<?php echo esc_attr($this->get_field_name('icon-bg-color')); ?>" type="text" value="<?php echo esc_attr($instance['icon-bg-color']); ?>" />    
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('icon-hover-color')); ?>"><?php _e("Icon hover color:", 'wdv-about-me-widget'); ?></label><br> 
            <input id="icon-hover-color-field" id="<?php echo esc_attr($this->get_field_id('icon-hover-color')); ?>" name="<?php echo esc_attr($this->get_field_name('icon-hover-color')); ?>" type="text" value="<?php echo esc_attr($instance['icon-hover-color']); ?>" />    
        </p><br>
        
        <!---------------------------->
        <!--Social links--> 
        <!---------------------------->
        <label for="<?php echo $this->get_field_id('text_area'); ?>">
            <?php echo('ADD SOCIAL LINKS:'); ?>
        </label><br>         
        
        <?php
        $faicons = $this->icons;

        echo '<div class="wdv-icon-list">';
        for ($i = 0; $i < count($faicons); $i++) {
            echo '<a class="btn tooltip" id="' . $faicons[$i]['icon'] . '" href="#">'
                    .'<div class="top">
                        <div>' . $faicons[$i]['icon'] . '</div>
                        
                    </div>'
                    . '' . $faicons[$i]['icon-i'] . '</a>';
            
        }
        echo '</div><br>';
        ?>


        <div class="wdv-icon-input">
            <?php
            for ($i = 0; $i < count($faicons); $i++) {
                if (($instance['icon' . $faicons[$i]['icon']])) {
                    echo '<div class="icon-input" id="icon-input-' . $faicons[$i]['icon'] . '" style="display:block;">';
                } else {
                    echo '<div class="icon-input" id="icon-input-' . $faicons[$i]['icon'] . '" style="display:none;">';
                }
                echo '<label for="' . esc_attr($this->get_field_id('icon' . $faicons[$i]['icon'])) . '">' . $faicons[$i]['icon'] . ':</label>';
                echo '<div class="icon-i">' . $faicons[$i]['icon-i'] . '</div>';

                echo '<div class="inline"><input class="widefat" type="text" id="' . esc_attr($this->get_field_id('icon-' . $faicons[$i]['icon'])) . '" name="' . esc_attr($this->get_field_name('icon' . $faicons[$i]['icon'])) . '" value="' . esc_attr($instance['icon' . $faicons[$i]['icon']]) . '"/></div>';

                echo '</div>';
            }
            ?>
        </div>
        <?php
    }

    //backend update
    public function update($new_instance, $old_instance) {
        $new_instance['title'] = strip_tags($new_instance['title']);
        $new_instance['image'] = esc_url_raw($new_instance['image']);

        $new_instance['img-width'] = (int)($new_instance['img-width']);
        $new_instance['img-height'] = (int)($new_instance['img-height']);
        $new_instance['img-radius'] = (int)($new_instance['img-radius']);
        $new_instance['align'] = strip_tags($new_instance['align']);
        $new_instance['name'] = strip_tags($new_instance['name']);
        $new_instance['profession'] = strip_tags($new_instance['profession']);
        $new_instance['description'] = esc_textarea($new_instance['description']);
        $new_instance['link-text'] = strip_tags($new_instance['link-text']);
        $new_instance['link-address'] = strip_tags($new_instance['link-address']);
        $new_instance['link-align'] = strip_tags($new_instance['link-align']);
        $new_instance['text_new_tab'] = strip_tags($new_instance['text_new_tab']);
        
        $new_instance['contact-icon-color'] = strip_tags($new_instance['contact-icon-color']); 
        $new_instance['contact-text'] = strip_tags($new_instance['contact-text']);        
        $new_instance['contact-address'] = strip_tags($new_instance['contact-address']);
        $new_instance['contact-phone'] = strip_tags($new_instance['contact-phone']);
        $new_instance['contact-email'] = strip_tags($new_instance['contact-email']);
        $new_instance['contact-skype'] = strip_tags($new_instance['contact-skype']);
        $new_instance['contact-whatsapp'] = strip_tags($new_instance['contact-whatsapp']);
        $new_instance['contact-viber'] = strip_tags($new_instance['contact-viber']);
        
        $new_instance['icon-font-size'] = (int)($new_instance['icon-font-size']);
        $new_instance['icon-padding'] = (int)($new_instance['icon-padding']);
        $new_instance['icon-border-radius'] = (int)($new_instance['icon-border-radius']);
        $new_instance['icon-color'] = strip_tags($new_instance['icon-color']);
        $new_instance['icon-bg-color'] = strip_tags($new_instance['icon-bg-color']);
        $new_instance['icon-hover-color'] = strip_tags($new_instance['icon-hover-color']);

        $new_instance['iconBehance'] = strip_tags($new_instance['iconBehance']);
        $new_instance['iconBlogger'] = strip_tags($new_instance['iconBlogger']);
        $new_instance['iconCodepen'] = strip_tags($new_instance['iconCodepen']);
        $new_instance['iconDeviantart'] = strip_tags($new_instance['iconDeviantart']);
        $new_instance['iconDribbble'] = strip_tags($new_instance['iconDribbble']);
        $new_instance['iconFacebook'] = strip_tags($new_instance['iconFacebook']);
        $new_instance['iconFlickr'] = strip_tags($new_instance['iconFlickr']);        
        $new_instance['iconFoursquare'] = strip_tags($new_instance['iconFoursquare']);        
        $new_instance['iconGithub'] = strip_tags($new_instance['iconGithub']);        
        $new_instance['iconGitlab'] = strip_tags($new_instance['iconGitlab']);
        $new_instance['iconInstagram'] = strip_tags($new_instance['iconInstagram']);
        $new_instance['iconLinkedin'] = strip_tags($new_instance['iconLinkedin']);        
        $new_instance['iconMedium'] = strip_tags($new_instance['iconMedium']);        
        $new_instance['iconMeetup'] = strip_tags($new_instance['iconMeetup']);         
        $new_instance['iconOdnoklassniki'] = strip_tags($new_instance['iconOdnoklassniki']);
        $new_instance['iconPeriscope'] = strip_tags($new_instance['iconPeriscope']);
        $new_instance['iconPinterest'] = strip_tags($new_instance['iconPinterest']);        
        $new_instance['iconPocket'] = strip_tags($new_instance['iconPocket']);        
        $new_instance['iconQq'] = strip_tags($new_instance['iconQq']);         
        $new_instance['iconReddit'] = strip_tags($new_instance['iconReddit']);
        $new_instance['iconStumbleupon'] = strip_tags($new_instance['iconStumbleupon']);
        $new_instance['iconSlack'] = strip_tags($new_instance['iconSlack']);        
        $new_instance['iconSnapchat'] = strip_tags($new_instance['iconSnapchat']);        
        $new_instance['iconSoundcloud'] = strip_tags($new_instance['iconSoundcloud']);         
        $new_instance['iconSpotify'] = strip_tags($new_instance['iconSpotify']);
        $new_instance['iconStackoverflow'] = strip_tags($new_instance['iconStackoverflow']);
        $new_instance['iconTelegram'] = strip_tags($new_instance['iconTelegram']);        
        $new_instance['iconTripadvisor'] = strip_tags($new_instance['iconTripadvisor']);        
        $new_instance['iconTumblr'] = strip_tags($new_instance['iconTumblr']);         
        $new_instance['iconTwitch'] = strip_tags($new_instance['iconTwitch']);
        $new_instance['iconTwitter'] = strip_tags($new_instance['iconTwitter']);
        $new_instance['iconViadeo'] = strip_tags($new_instance['iconViadeo']);        
        $new_instance['iconVimeo'] = strip_tags($new_instance['iconVimeo']);        
        $new_instance['iconVine'] = strip_tags($new_instance['iconVine']);         
        $new_instance['iconVk'] = strip_tags($new_instance['iconVk']);
        $new_instance['iconWeibo'] = strip_tags($new_instance['iconWeibo']);
        $new_instance['iconWechat'] = strip_tags($new_instance['iconWechat']);        
        $new_instance['iconWordpress'] = strip_tags($new_instance['iconWordpress']);        
        $new_instance['iconXing'] = strip_tags($new_instance['iconXing']);  
        $new_instance['iconYelp'] = strip_tags($new_instance['iconYelp']);        
        $new_instance['iconYoutube'] = strip_tags($new_instance['iconYoutube']);        
        $new_instance['iconYoast'] = strip_tags($new_instance['iconYoast']);
 
        return $new_instance;
    }

}
