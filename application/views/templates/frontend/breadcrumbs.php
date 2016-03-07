	<section id="breadcrumb" class="breadcrumbs">
        <div class="container">
            <h1><?php echo $titulo; ?></h1>
            
            <ol class="breadcrumb" style="margin-left: 0; padding-left: 0; margin-bottom: 3px; padding-bottom: 0;">
                <li><a href="<?php echo base_url(); ?>">Inicio</a></li>
                <?php $exp_uri_breadcrumb = explode('/', uri_string()); ?>
                <?php for ($i=0; $i < count($exp_uri_breadcrumb); $i++): ?>
                <?php if ($i == count($exp_uri_breadcrumb)-1): ?>
                <li class="active"><?php echo str_replace('-', ' ', $titulo); ?></li>
                <?php else: ?>
                <li><?php echo anchor(base_url().'index.php/'.$exp_uri_breadcrumb[$i], ucfirst(str_replace('-', ' ', $exp_uri_breadcrumb[$i]))); ?></li>
                <?php endif; ?>
                <?php endfor; ?>
            </ol>
        </div>
    </section>