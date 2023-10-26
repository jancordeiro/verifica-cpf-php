<!DOCTYPE html>
<html>
<head>
	<title>Validação de CPF</title>
</head>
<body>
	<form method="post">
		<label>Informe o CPF:</label>
		<input type="text" name="cpf">
		<input type="submit" value="Validar">
	</form>

	<?php
		if ($_POST) {
			$cpf = $_POST['cpf'];

			if (validaCPF($cpf)) {
				echo "<p>CPF válido.</p>";
			} else {
				echo "<p>CPF inválido.</p>";
			}
		}

		function validaCPF($cpf) {
			$cpf = preg_replace('/[^0-9]/', '', $cpf);

			if (strlen($cpf) != 11 || preg_match('/^([0-9])\1*$/', $cpf)) {
				return false;
			}

			for ($i = 9; $i < 11; $i++) {
				$j = 0;

				for ($k = 0; $k < $i; $k++) {
					$j += $cpf{$k} * (($i + 1) - $k);
				}

				$j = ((10 * $j) % 11) % 10;

				if ($cpf{$i} != $j) {
					return false;
				}
			}

			return true;
		}
	?>
</body>
</html>
