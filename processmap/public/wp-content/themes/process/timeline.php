<section id="timeline">
	<div class="row timeline">
	<div class="twelve columns timeline-inner">

		<?php 

			$this_post_id   = $post->ID;
			$this_is_parent = ($post->post_parent === 0);

			$head = array();
			global $phaseIndexOrder;
			$phaseIndexOrder = array();
			$phases = array();
			$steps = array();

			$totalCols = 0;
			$nullArray = array(false,false,false,false,false,false,false);

			$query = new WP_Query(array(
				'post_type'   => (\Duarte\Process\is_studio()) ? 'studio' : 'factory',
				'post_status' => 'publish',
				'orderby'     => 'parent menu_order',
				'order'       => 'ASC',
				'nopaging'    => true
			));

			// Start New Loop
			while( $query->have_posts() ){
				$query->the_post();

				if($post->post_parent === 0){
					$phases[] = array(
						'id'        => get_the_ID(),
						'title'     => get_the_title(),
						'permalink' => get_permalink(),
						'num_steps' => 0
					);
					$phaseIndexOrder[] = get_the_ID();
				}
				else {
					$res = get_field('responsibilities');
					$res = (is_array($res)) ? array_replace($nullArray, array_flip($res)) : $nullArray;

					$steps[] = array(
						'id'       => get_the_ID(),
						'title'    => get_the_title(),
						'phase_id' => $post->post_parent,
						'res'      => $res,
						'link'     => get_permalink(),
						'active'   => (get_the_ID() === $this_post_id),
						'menu_order' => $post->menu_order,
						'first'    => false
					);
					$totalCols++;					
				}
			}
			wp_reset_postdata();
			// End Loop
			

			// establish phase/step order
			foreach($steps as &$s) {
				foreach($phases as &$phase){ 
					if($phase['id'] === $s['phase_id']) {						
						$s['first'] = ($phase['num_steps'] === 0);
						$phase['num_steps'] += 1;
						break;
					}
				}				
			}

			$phaseIndexOrder = array_flip($phaseIndexOrder);
			// sort the steps array by phase, then menu order inside phase
			usort($steps, function($a, $b){
				global $phaseIndexOrder;
				$i = $phaseIndexOrder[ $a['phase_id'] ];
				$j = $phaseIndexOrder[ $b['phase_id'] ];

				if ($i == $j) {
        			//phas is same. sort by menu order 
					if($a['menu_order'] == $b['menu_order']) return 0;
        			return ($a['menu_order'] < $b['menu_order']) ? -1 : 1;	
			    }
			    return ($i < $j) ? -1 : 1;
			});			

			// Create Phase Headings
			foreach($phases as $p){
				$head[] = sprintf('<th colspan="%s"><a href="%s">%s</a></th>', 
					$p['num_steps'], 
					$p['permalink'], 
					$p['title']
				);
			}
		?>

		<?php if( \Duarte\Process\is_studio()) : ?>
			<ul class="legend none">
				<li class="has-tip tip-right" title="Client">CL</li>
				<li class="has-tip tip-right" title="Account Manager">AM</li>
				<li class="has-tip tip-right" title="Project Manager">PM</li>
				<li class="has-tip tip-right" title="Designer">DZ</li>
				<li class="has-tip tip-right" title="Content">CN</li>
				<li class="has-tip tip-right" title="Art Director">AD</li>
				<li class="has-tip tip-right" title="Admin">AN</li>
			</ul>
		<?php else: ?>
			<ul class="legend none">
				<li class="has-tip tip-right" title="Client">CL</li>
				<li class="has-tip tip-right" title="Account Manager">AM</li>
				<li class="has-tip tip-right" title="Project Manager">PM</li>
				<li class="has-tip tip-right" title="Project Coordinator">PC</li>
				<li class="has-tip tip-right" title="Designer">DZ</li>
				<li class="has-tip tip-right" title="Contractor">CN</li>
				<li class="has-tip tip-right" title="Admin">AN</li>
			</ul>
		<?php endif; ?>

		<table class="">
			<thead><tr><?php echo implode($head, "\n"); ?></tr></thead>
			<tbody>
			<?php
				$rows = $nullArray;
				foreach($steps as $index => $step){

					for($i=0; $i < count($nullArray); $i++) {
						$td_class = array("has-tip","tip-top");
						$inner = "";
						// this cell is going to be the start of a phase
						if($step['first'] && $index > 0){
							$td_class[] = "phase";
						}
						if($step['active'] && !$this_is_parent){
							$td_class[] = "active-step";
						}
						if($step['res'][$i] !== false){
							$td_class[] = "active";
							$inner = "<div></div>";
						}
						if($this_is_parent && $step['phase_id'] === $this_post_id) {
							$td_class[] = "active-phase";
						}
						$rows[$i] .= sprintf('<td data-href="%s" class="%s" title="%s">%s</td>'."\n", 
							$step['link'], 
							implode(" ", $td_class),
							$step['title'],
							$inner	
						);
					}
				}

				foreach($rows as $row) { echo "<tr>$row</tr>"; }

			?>
			</tbody>
		</table>
		<style type="text/css">
			.timeline td { width: <?php echo (100/$totalCols); ?>%; } 
		</style>

	</div>
	</div>
</section>