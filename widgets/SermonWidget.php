<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class SermonWidget extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'Sermons cards';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Sermons Cards', 'elementor-test-addon');
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-header';
    }

    /**
     * Get custom help URL.
     *
     * Retrieve a URL where the user can get more information about the widget.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget help URL.
     */
    public function get_custom_help_url()
    {
        return 'https://developers.elementor.com/docs/widgets/';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['general'];
    }


    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return ['Sermon'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        // style controls
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Style', 'essential-elementor-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .contenue_texte',
            ]
        );


        $this->add_control(
            'description_options',
            [
                'label' => esc_html__('Description Options', 'essential-elementor-widget'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'essential-elementor-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f00',
                'selectors' => [
                    '{{WRAPPER}} .description_texte' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .description_texte',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {

        $settings = $this->get_settings_for_display();
        $arg = array('post_type' => 'sermons', 'posts_per_page' => 3);
        $recentPost = wp_get_recent_posts($arg);
        $sermons = array('post_type' => 'sermons', 'posts_per_page' => 6);
        $SermonsRecentPost = wp_get_recent_posts($sermons);
?>
        <div class="sermon-card">
            <h4 class="sermon-heading">Les plus récents</h4>
            <div class="sermon-container">
                <?php
                foreach ($recentPost as $key => $post) :
                ?>
                    <div class="sermon-item-container">
                        <div class="sermon-item">
                            <img class="sermon-img" src="<?php echo get_the_post_thumbnail_url($post['ID']) ?>" alt="Card image cap">
                        </div>
                        <div>
                            <h5 class="sermon-info"><?= $post['post_title'] ?> | <span class="sermon-content"><?= $post['post_content'] ?></span> | <?php $date = new DateTime($post['post_date']);
                                                                                                                                                    echo $date->format('Y/m/d') ?> </h5>
                        </div>
                    </div>
                <?php
                endforeach
                ?>
            </div>
        </div>


        <div class="sermon-card">
            <h4 class="sermon-heading">Autres enseignements</h4>
            <div class="sermon-container">
                <?php
                foreach ($SermonsRecentPost as $key => $post) :
                ?>
                    <div class="sermon-item-container">
                        <div class="sermon-item">
                            <img class="sermon-img" src="<?php echo get_the_post_thumbnail_url($post['ID']) ?>" alt="Card image cap">
                        </div>
                        <div>
                            <h5 class="sermon-info"><?= $post['post_title'] ?> | <span class="texte-reduit sermon-content"><?= $post['post_name'] ?></span> | <?php $date = new DateTime($post['post_date']);
                                                                                                                                                    echo $date->format('Y/m/d') ?> </h5>
                        </div>
                    </div>
                <?php
                endforeach
                ?>
            </div>
        </div>
<?php
    }
}
