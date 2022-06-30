<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>'Bienvenidos',//.CHtml::encode(Yii::app()->name),
)); ?>


<h2>MODULO PRE-EMBARQUE</h2>

<p>Reglas Importantes para Input</p>

<p>A continuación se detallan las reglas importantes a tomar en cuenta al realizar un input en el Modulo Preembarque:</p>


<ul>

<!--    <li>View file: <code><?php echo __FILE__; ?></code></li>
    <li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
    -->

	<ol>

		<li>En las exportaciones el status se va a enviar:
			<ul>
				<li>a. Siempre al shipper</li>
				<li>b. Se enviará el status al cliente unicamente si la carga tiene destino Centroamerica incluyendo Belice y
			Panama.</li>
			</ul>
		</li>  
		  
		<br>
		 
		<li>La persona que elaboró el RO cliente será el contacto que aparezca en la autonotificación con su
		nombre, email y teléfono.</li>    

		<br>

		<li>Al momento de ingresar un status cuando uno de los países de origen o destino no es de
		Centroamerica entonces mosotrará los status de importación o exportación según sea el RO cliente que fue
		creado.</li>    

		<br>

		<li>Al momento de ingresar un status cuando uno de los países de origen o destino sean de Centroamerica
		los que status que mostrará son de exportación a los países de origen y los países destino no podrán
		ingresar status estarán bloqueados. Esto debido a que es el origen que debe registrar los status preembarque.</li>    

		<br>

		<li>A los RO Aduana o Terrestre Local no se les puede ingresar un status, debido a que son servicios en
		destino y los status son alimentados por operaciones.</li>

		<br>

		<li>Las reglas de Notify Party aplican en Modulo Pre-embarque:
			<ul>
				<li>a. Si en el RO cliente se llena el campo Notify Party con el código de un cliente el status llegará al notify
			party y al shipper según sea el caso.</li>
				<li>b. Si en el RO cliente se llena el campo Notify Party y adicional el campo Coloader el status llegará al notify
			party y al coloader.</li>
			</ul>
		</li>    

		<br>

		<li>Las reglas del Colaoder aplican en el Modulo Pre-embarque:
			<ul>
				<li>a. Si en el RO cliente se llena el campo Coloader el status llegará solamente al coloader.</li>		
			</ul>
		</li>    

	</ol>


    
</ul>





<?php $this->endWidget(); ?>
