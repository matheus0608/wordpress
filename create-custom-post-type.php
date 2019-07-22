<?php 

// Block direct acess
if ( ! defined( 'ABSPATH' ) ) { 
	exit;  
}

// CSS post type
function prefix_post_type_css() { 
	$labels = array(
		'name' => __( 'CSS' ),
		'singular_name' => __( 'CSS' ),
		'add_new' => _x( 'Adicionar Novo', 'Novo item' ),
		'add_new_item' => __( 'Novo Item' ),
		'edit_item' => __( 'Editar Item' ),
		'new_item' => __( 'Novo Item' ),
		'view_item' => __( 'Ver Item' ),
		'search_items' => __( 'Procurar Itens' ),
		'not_found' =>  __( 'Nenhum registro encontrado' ),
		'not_found_in_trash' => __( 'Nenhum registro encontrado na lixeira' ),
		'parent_item_colon' => '',
		'menu_name' =>  __( 'CSS' ),
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'public_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => true,
		'menu_position' => null,
		'register_meta_box_cb' => 'prefix_metabox_css',
		'supports' => array( 'title', 'editor' ),
	);

	register_post_type( 'css' , $args );
	flush_rewrite_rules();

	$labels_taxonomy_css = array(
		'name' => __( 'Categoria CSS' ),
		'singular_name' => __( 'Categoria CSS' ),
		'search_items' => __( 'Pesquisar' ),
		'all_items' => __( 'Todos' ),
		'parent_item' => __( 'Pai' ),
		'parent_item_colon' => __( 'Pai:' ),
		'edit_item' => __( 'Editar' ),
		'update_item' => __( 'Atualizar' ),
		'add_new_item' => __( 'Adicionar' ),
		'new_item_name' => __( 'Nova'),
		'menu_name' => __( 'Categoria CSS' ),
	);

	$args_taxonomy_css = array(
		'hierarchical' => true,
		'labels' => $labels_taxonomy_css,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'cat_css' ),
	);

	register_taxonomy(
		"cat_css", 
		"css", 
		$args_taxonomy_css
	);
}
add_action( 'init', 'prefix_post_type_css' );

function prefix_metabox_css(){        
	add_meta_box( 'prefix_metabox_css_id_css', __( 'Defaults' ), 'prefix_metabox_css_render_css', 'css' );
}

function prefix_metabox_css_render_css() {

	$prefix_postmeta_css_default = get_post_meta( get_the_ID(), 'prefix_postmeta_css_default', true ); 
	$prefix_postmeta_css_inherited = get_post_meta( get_the_ID(), 'prefix_postmeta_css_inherited', true ); 
	$prefix_postmeta_css_animatable = get_post_meta( get_the_ID(), 'prefix_postmeta_css_animatable', true ); 
	$prefix_postmeta_css_version = get_post_meta( get_the_ID(), 'prefix_postmeta_css_version', true ); 
	$prefix_postmeta_css_js = get_post_meta( get_the_ID(), 'prefix_postmeta_css_js', true ); 
	?>
	<p>
		<label for="prefix_field_css_default"> <?php echo esc_html( 'Default value: ' ); ?> 
			<input type="text" name="prefix_field_css_default" id="prefix_field_css_default" value="<?php echo $prefix_postmeta_css_default; ?>" class="regular-text">
		</label>
	</p>
	<p>
		<label for="prefix_field_css_inherited"> <?php echo esc_html( 'Inherited: ' ); ?> 
			<input type="text" name="prefix_field_css_inherited" id="prefix_field_css_inherited" value="<?php echo $prefix_postmeta_css_inherited; ?>" class="regular-text">
		</label>
	</p>
	<p>
		<label for="prefix_field_css_animatable"> <?php echo esc_html( 'Animatable: ' ); ?> 
			<input type="text" name="prefix_field_css_animatable" id="prefix_field_css_animatable" value="<?php echo $prefix_postmeta_css_animatable; ?>" class="regular-text">
		</label>
	</p>
	<p>
		<label for="prefix_field_css_version"> <?php echo esc_html( 'Version: ' ); ?> 
			<input type="text" name="prefix_field_css_version" id="prefix_field_css_version" value="<?php echo $prefix_postmeta_css_version; ?>" class="regular-text">
		</label>
	</p>
	<p>
		<label for="prefix_field_css_js"> <?php echo esc_html( 'JavaScript syntax: ' ); ?> 
			<input type="text" name="prefix_field_css_js" id="prefix_field_css_js" value="<?php echo $prefix_postmeta_css_js; ?>"  class="regular-text">
		</label>
	</p>
<?php
}

function prefix_metabox_css_save( $post_id ) {
	if ( isset( $_POST['publish']) || isset( $_POST['save'] ) ) { 
		if ( isset( $_POST['prefix_field_css_default']) ) { 
			update_post_meta( $post_id, 'prefix_postmeta_css_default', sanitize_text_field( $_POST['prefix_field_css_default'] ) );
		}
		if ( isset( $_POST['prefix_field_css_inherited'] ) ) { 
			update_post_meta( $post_id, 'prefix_postmeta_css_inherited', sanitize_text_field( $_POST['prefix_field_css_inherited'] ) );
		}
		if ( isset( $_POST['prefix_field_css_animatable'] ) ) { 
			update_post_meta( $post_id, 'prefix_postmeta_css_animatable', sanitize_text_field( $_POST['prefix_field_css_animatable'] ) );
		}
		if ( isset( $_POST['prefix_field_css_version'] ) ) { 
			update_post_meta( $post_id, 'prefix_postmeta_css_version', sanitize_text_field( $_POST['prefix_field_css_version'] ) );
		}
		if ( isset( $_POST['prefix_field_css_js'] ) ) { 
			update_post_meta( $post_id, 'prefix_postmeta_css_js', sanitize_text_field( $_POST['prefix_field_css_js'] ) );
		}
	}
}
add_action( 'save_post', 'prefix_metabox_css_save' );
