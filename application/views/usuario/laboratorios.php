<h3>Meus Laboratórios</h3>
<hr>

<?php if(empty($laboratorios)): echo "<h4>Você não realiza atividade em nenhum laboratório.</h4>"; else: ?>

<table style="width:100%;">
  <thead>
    <tr>
      <th width="650">Laboratório</th>
    </tr>
  </thead>
  <tbody>
		<?php foreach ($laboratorios as $key): ?>

			<tr>
				<?php $link = base_url().'search/laboratorio/'.$key->id_laboratorio.'/'; ?>
				<td>
					<a href="<?php echo $link; ?>" target="_blank" title="Visitar página do laboratório"><?php echo $key->nome_lab; ?></a>
				</td>
			</tr>

		<?php endforeach; ?>

  </tbody>
</table>

<?php endif; ?>