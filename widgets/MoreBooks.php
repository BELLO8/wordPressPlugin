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

class MoreBooks extends \Elementor\Widget_Base
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
        return 'book card';
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
        return esc_html__('More books', 'elementor-test-addon');
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
        return ['Actualites'];
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
                'selector' => '{{WRAPPER}} .article_content',
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
                    '{{WRAPPER}} .description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typo',
                'selector' => '{{WRAPPER}} .description',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'essential-elementor-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f00',
                'selectors' => [
                    '{{WRAPPER}} .description_texte_article' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .description_texte_article',
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
        $arg = array(
            'post_type' => 'post',
            'posts_per_page' => 8,
        );
        $recent_post = wp_get_recent_posts($arg);
?>

        <div class="more-book-container">
            <?php
            foreach ($recent_post as $key => $post) :
            ?>
                <div class="more-book-item-container">
                    <img class="more-book-img" src="<?php echo get_the_post_thumbnail_url($post['ID']) ?>" alt="Card image cap">
                </div>
            <?php
            endforeach
            ?>
        </div>

<?php
    }
}
