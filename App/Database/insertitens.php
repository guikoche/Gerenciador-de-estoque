<?php
require_once '../auth.php';
require_once '../Models/itens.class.php';

if (isset($_POST['upload']) == 'Cadastrar') {

    // Verifica se a chave 'QuantItens' está definida no array $_POST antes de acessá-la
    $QuantItens = isset($_POST['QuantItens']) ? $_POST['QuantItens'] : null;
    
    // Verifica se a chave 'ValCompItens' está definida no array $_POST antes de acessá-la
    $ValCompItens = isset($_POST['ValCompItens']) ? $_POST['ValCompItens'] : null;
    
    // Verifica se a chave 'ValVendItens' está definida no array $_POST antes de acessá-la
    $ValVendItens = isset($_POST['ValVendItens']) ? $_POST['ValVendItens'] : null;
    
    // Verifica se a chave 'DataCompraItens' está definida no array $_POST antes de acessá-la
    $DataCompraItens = isset($_POST['DataCompraItens']) ? $_POST['DataCompraItens'] : null;
    
    // Verifica se a chave 'DataVenci_Itens' está definida no array $_POST antes de acessá-la
    $DataVenci_Itens = isset($_POST['DataVenci_Itens']) ? $_POST['DataVenci_Itens'] : null;
    
    // Verifica se a chave 'codProduto' está definida no array $_POST antes de acessá-la
    $Produto_CodRefProduto = isset($_POST['codProduto']) ? $_POST['codProduto'] : null;
    
    // Verifica se a chave 'idFabricante' está definida no array $_POST antes de acessá-la
    $Fabricante_idFabricante = isset($_POST['idFabricante']) ? $_POST['idFabricante'] : null;

	$iduser = $_POST['iduser'];

	if ($iduser == $idUsuario && $QuantItens != NULL) {

		if (!file_exists($_FILES['arquivo']['name'])) {

			$pt_file =  '../../views/dist/img/products/' . $_FILES['arquivo']['name'];

			if ($pt_file != '../../views/dist/img/products/') {

				$destino =  '../../views/dist/img/products/' . $_FILES['arquivo']['name'];
				$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
				move_uploaded_file($arquivo_tmp, $destino);
				chmod($destino, 0644);

				$nomeimagem =  'dist/img/products/' . $_FILES['arquivo']['name'];
			} elseif ($_POST['valor'] != NULL) {

				$nomeimagem = $_POST['valor'];
			}
		}
		
		$nomeimagem = '';
		
		if (isset($_POST['idItens'])) {

			$idItens = $_POST['idItens'];
			$itens->updateItens($idItens, $nomeimagem, $QuantItens, $ValCompItens, $ValVendItens, $DataCompraItens, $DataVenci_Itens, $Produto_CodRefProduto, $Fabricante_idFabricante, $idUsuario);
		} else {
			$itens->InsertItens($nomeimagem, $QuantItens, $ValCompItens, $ValVendItens, $DataCompraItens, $DataVenci_Itens, $Produto_CodRefProduto, $Fabricante_idFabricante, $idUsuario);
		}
	} else {
		header('Location: ../../views/itens/index.php?alert=3');
	}
} else {
	header('Location: ../../views/itens/index.php');
}
