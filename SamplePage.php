<?php include "../inc/dbinfo.inc"; ?>
<html>
<head>
    <title>Sistema de Gerenciamento de Produtos e Fornecedores</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #e67e22;
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f5f0eb;
        }
        .tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 2px solid #f5f0eb;
        }
        .tab {
            padding: 12px 24px;
            background-color: #f5f0eb;
            color: #e67e22;
            border: none;
            cursor: pointer;
            font-weight: 600;
            margin-right: 5px;
            border-radius: 5px 5px 0 0;
        }
        .tab.active {
            background-color: #e67e22;
            color: white;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        form {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #fef5eb;
            border-radius: 5px;
            border-left: 4px solid #e67e22;
        }
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }
        .form-group {
            flex: 1;
            min-width: 200px;
            margin-right: 15px;
        }
        .form-group:last-child {
            margin-right: 0;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #d35400;
        }
        input, textarea, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #f0e0d0;
            border-radius: 4px;
            font-size: 15px;
            background-color: #fff;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        button {
            background-color: #e67e22;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s;
            box-shadow: 0 2px 5px rgba(230, 126, 34, 0.3);
        }
        button:hover {
            background-color: #d35400;
        }
        .btn-delete {
            background-color: #e74c3c;
            padding: 8px 15px;
            font-size: 14px;
        }
        .btn-delete:hover {
            background-color: #c0392b;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }
        th {
            background-color: #e67e22;
            color: white;
            text-align: left;
            padding: 14px;
            font-weight: 600;
        }
        td {
            padding: 14px;
            border-bottom: 1px solid #f0e0d0;
        }
        tr:nth-child(even) {
            background-color: #fef9f4;
        }
        tr:hover {
            background-color: #fef0e0;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .price {
            font-weight: bold;
            color: #e67e22;
        }
        .stock-low {
            color: #e74c3c;
            font-weight: bold;
        }
        .stock-ok {
            color: #27ae60;
        }
        .actions {
            text-align: center;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 400px;
            max-width: 80%;
            text-align: center;
        }
        .modal-actions {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .btn-cancel {
            background-color: #95a5a6;
        }
        .btn-cancel:hover {
            background-color: #7f8c8d;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a {
            color: #e67e22;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color 0.3s;
            border: 1px solid #f0e0d0;
            margin: 0 4px;
        }
        .pagination a.active {
            background-color: #e67e22;
            color: white;
            border: 1px solid #e67e22;
        }
        .pagination a:hover:not(.active) {
            background-color: #fef0e0;
        }
        @media (max-width: 768px) {
            .form-group {
                flex: 100%;
                margin-right: 0;
                margin-bottom: 15px;
            }
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            .tabs {
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Sistema de Gerenciamento de Produtos e Fornecedores</h1>
    
    <?php
    $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    if (mysqli_connect_errno()) {
        echo '<div class="alert alert-danger">Falha na conexão com MySQL: ' . mysqli_connect_error() . '</div>';
    }
    $database = mysqli_select_db($connection, DB_DATABASE);
    
    VerifyProductsTable($connection, DB_DATABASE);
    VerifySuppliersTable($connection, DB_DATABASE);
    
    $message = '';
    
    $product_name = '';
    $product_description = '';
    $product_price = '';
    $product_stock = '';
    
    $supplier_name = '';
    $supplier_email = '';
    $supplier_phone = '';
    $supplier_active = '1';
    $supplier_rating = '';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product'])) {
        $product_id = (int) $_POST['delete_product'];
        if (DeleteProduct($connection, $product_id)) {
            $message = '<div class="alert alert-success">Produto excluído com sucesso!</div>';
        } else {
            $message = '<div class="alert alert-danger">Erro ao excluir produto.</div>';
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_supplier'])) {
        $supplier_id = (int) $_POST['delete_supplier'];
        if (DeleteSupplier($connection, $supplier_id)) {
            $message = '<div class="alert alert-success">Fornecedor excluído com sucesso!</div>';
        } else {
            $message = '<div class="alert alert-danger">Erro ao excluir fornecedor.</div>';
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'product') {
        $product_name = htmlentities($_POST['product_name']);
        $product_description = htmlentities($_POST['product_description']);
        $product_price = htmlentities($_POST['product_price']);
        $product_stock = htmlentities($_POST['product_stock']);
        
        if (strlen($product_name) && is_numeric($product_price) && is_numeric($product_stock)) {
            if (AddProduct($connection, $product_name, $product_description, $product_price, $product_stock)) {
                $message = '<div class="alert alert-success">Produto adicionado com sucesso!</div>';
                $product_name = '';
                $product_description = '';
                $product_price = '';
                $product_stock = '';
            } else {
                $message = '<div class="alert alert-danger">Erro ao adicionar produto.</div>';
            }
        } else {
            $message = '<div class="alert alert-danger">Por favor, preencha todos os campos obrigatórios do produto corretamente.</div>';
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'supplier') {
        $supplier_name = htmlentities($_POST['supplier_name']);
        $supplier_email = htmlentities($_POST['supplier_email']);
        $supplier_phone = htmlentities($_POST['supplier_phone']);
        $supplier_active = isset($_POST['supplier_active']) ? '1' : '0';
        $supplier_rating = htmlentities($_POST['supplier_rating']);
        
        if (strlen($supplier_name) && strlen($supplier_email) && strlen($supplier_phone) && is_numeric($supplier_rating)) {
            if (AddSupplier($connection, $supplier_name, $supplier_email, $supplier_phone, $supplier_active, $supplier_rating)) {
                $message = '<div class="alert alert-success">Fornecedor adicionado com sucesso!</div>';
                $supplier_name = '';
                $supplier_email = '';
                $supplier_phone = '';
                $supplier_active = '1';
                $supplier_rating = '';
            } else {
                $message = '<div class="alert alert-danger">Erro ao adicionar fornecedor.</div>';
            }
        } else {
            $message = '<div class="alert alert-danger">Por favor, preencha todos os campos obrigatórios do fornecedor corretamente.</div>';
        }
    }
    
    echo $message;
    ?>
    
    <div class="tabs">
        <button class="tab active" onclick="openTab(event, 'products')">Produtos</button>
        <button class="tab" onclick="openTab(event, 'suppliers')">Fornecedores</button>
    </div>
    
    <div id="products" class="tab-content active">
        <form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
            <input type="hidden" name="form_type" value="product">
            <div class="form-row">
                <div class="form-group">
                    <label for="product_name">Nome do Produto*</label>
                    <input type="text" id="product_name" name="product_name" maxlength="100" required value="<?php echo $product_name; ?>" />
                </div>
                <div class="form-group">
                    <label for="product_price">Preço (R$)*</label>
                    <input type="number" id="product_price" name="product_price" min="0" step="0.01" required value="<?php echo $product_price; ?>" />
                </div>
                <div class="form-group">
                    <label for="product_stock">Estoque*</label>
                    <input type="number" id="product_stock" name="product_stock" min="0" required value="<?php echo $product_stock; ?>" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="product_description">Descrição</label>
                    <textarea id="product_description" name="product_description" maxlength="500"><?php echo $product_description; ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <button type="submit">Cadastrar Produto</button>
                </div>
            </div>
        </form>
        
        <h2>Produtos Cadastrados</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Data de Cadastro</th>
                <th>Ações</th>
            </tr>
            <?php
            $result = mysqli_query($connection, "SELECT * FROM PRODUCTS ORDER BY id DESC");
            if ($result) {
                while($query_data = mysqli_fetch_row($result)) {
                    $stockClass = ($query_data[4] < 10) ? 'stock-low' : 'stock-ok';
                    echo "<tr>";
                    echo "<td>", $query_data[0], "</td>",
                         "<td>", $query_data[1], "</td>",
                         "<td>", $query_data[2], "</td>",
                         "<td class='price'>R$ ", number_format($query_data[3], 2, ',', '.'), "</td>",
                         "<td class='$stockClass'>", $query_data[4], "</td>",
                         "<td>", $query_data[5], "</td>";
                    echo "<td class='actions'>";
                    echo "<button type='button' class='btn-delete' onclick='confirmDelete(\"product\", ", $query_data[0], ", \"", addslashes($query_data[1]), "\")'>Excluir</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                mysqli_free_result($result);
            }
            ?>
        </table>
    </div>
    
    <div id="suppliers" class="tab-content">
        <form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
            <input type="hidden" name="form_type" value="supplier">
            <div class="form-row">
                <div class="form-group">
                    <label for="supplier_name">Nome do Fornecedor*</label>
                    <input type="text" id="supplier_name" name="supplier_name" maxlength="100" required value="<?php echo $supplier_name; ?>" />
                </div>
                <div class="form-group">
                    <label for="supplier_email">Email*</label>
                    <input type="email" id="supplier_email" name="supplier_email" maxlength="100" required value="<?php echo $supplier_email; ?>" />
                </div>
                <div class="form-group">
                    <label for="supplier_phone">Telefone*</label>
                    <input type="text" id="supplier_phone" name="supplier_phone" maxlength="20" required value="<?php echo $supplier_phone; ?>" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="supplier_rating">Avaliação (1-5)*</label>
                    <input type="number" id="supplier_rating" name="supplier_rating" min="1" max="5" step="0.1" required value="<?php echo $supplier_rating; ?>" />
                </div>
                <div class="form-group">
                    <label for="supplier_active">Status</label>
                    <div style="margin-top: 10px;">
                        <input type="checkbox" id="supplier_active" name="supplier_active" style="width: auto;" <?php echo $supplier_active == '1' ? 'checked' : ''; ?> />
                        <label for="supplier_active" style="display: inline;">Ativo</label>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <button type="submit">Cadastrar Fornecedor</button>
                </div>
            </div>
        </form>
        
        <h2>Fornecedores Cadastrados</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Status</th>
                <th>Avaliação</th>
                <th>Data de Cadastro</th>
                <th>Ações</th>
            </tr>
            <?php
            $result = mysqli_query($connection, "SELECT * FROM SUPPLIERS ORDER BY id DESC");
            if ($result) {
                while($query_data = mysqli_fetch_row($result)) {
                    $status = ($query_data[4] == 1) ? '<span style="color: #27ae60; font-weight: bold;">Ativo</span>' : '<span style="color: #e74c3c;">Inativo</span>';
                    echo "<tr>";
                    echo "<td>", $query_data[0], "</td>",
                         "<td>", $query_data[1], "</td>",
                         "<td>", $query_data[2], "</td>",
                         "<td>", $query_data[3], "</td>",
                         "<td>", $status, "</td>",
                         "<td>", number_format($query_data[5], 1), "</td>",
                         "<td>", $query_data[6], "</td>";
                    echo "<td class='actions'>";
                    echo "<button type='button' class='btn-delete' onclick='confirmDelete(\"supplier\", ", $query_data[0], ", \"", addslashes($query_data[1]), "\")'>Excluir</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                mysqli_free_result($result);
            }
            ?>
        </table>
    </div>
    
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h3>Confirmar Exclusão</h3>
            <p id="deleteMessage">Tem certeza que deseja excluir este item?</p>
            <div class="modal-actions">
                <form method="POST" id="deleteForm">
                    <input type="hidden" id="deleteItemId" name="">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Cancelar</button>
                    <button type="submit" class="btn-delete">Excluir</button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
                tabcontent[i].classList.remove("active");
            }
            
            tablinks = document.getElementsByClassName("tab");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            
            document.getElementById(tabName).style.display = "block";
            document.getElementById(tabName).classList.add("active");
            evt.currentTarget.classList.add("active");
        }
        
        function confirmDelete(type, id, name) {
            document.getElementById('deleteMessage').innerText = 'Tem certeza que deseja excluir "' + name + '"?';
            document.getElementById('deleteItemId').name = 'delete_' + type;
            document.getElementById('deleteItemId').value = id;
            document.getElementById('deleteModal').style.display = 'block';
        }
        
        function closeModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }
        
        window.onclick = function(event) {
            var modal = document.getElementById('deleteModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
    
    <?php mysqli_close($connection); ?>
</div>
</body>
</html>

<?php
function AddProduct($connection, $name, $description, $price, $stock) {
   $n = mysqli_real_escape_string($connection, $name);
   $d = mysqli_real_escape_string($connection, $description);
   $p = mysqli_real_escape_string($connection, $price);
   $s = mysqli_real_escape_string($connection, $stock);
   
   $query = "INSERT INTO PRODUCTS (name, description, price, stock, created_at) VALUES ('$n', '$d', '$p', '$s', NOW());";
   return mysqli_query($connection, $query);
}

function DeleteProduct($connection, $id) {
   $id = (int) $id;
   $query = "DELETE FROM PRODUCTS WHERE id = $id;";
   return mysqli_query($connection, $query);
}

function AddSupplier($connection, $name, $email, $phone, $active, $rating) {
   $n = mysqli_real_escape_string($connection, $name);
   $e = mysqli_real_escape_string($connection, $email);
   $p = mysqli_real_escape_string($connection, $phone);
   $a = mysqli_real_escape_string($connection, $active);
   $r = mysqli_real_escape_string($connection, $rating);
   
   $query = "INSERT INTO SUPPLIERS (name, email, phone, active, rating, created_at) VALUES ('$n', '$e', '$p', '$a', '$r', NOW());";
   return mysqli_query($connection, $query);
}

function DeleteSupplier($connection, $id) {
   $id = (int) $id;
   $query = "DELETE FROM SUPPLIERS WHERE id = $id;";
   return mysqli_query($connection, $query);
}

function VerifyProductsTable($connection, $dbName) {
  if(!TableExists("PRODUCTS", $connection, $dbName)) {
     $query = "CREATE TABLE PRODUCTS (
         id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(100) NOT NULL,
         description TEXT,
         price DECIMAL(10,2) NOT NULL,
         stock INT NOT NULL DEFAULT 0,
         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
       )";
     if(!mysqli_query($connection, $query)) echo("<div class='alert alert-danger'>Erro ao criar tabela de produtos.</div>");
  }
}

function VerifySuppliersTable($connection, $dbName) {
  if(!TableExists("SUPPLIERS", $connection, $dbName)) {
     $query = "CREATE TABLE SUPPLIERS (
         id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(100) NOT NULL,
         email VARCHAR(100) NOT NULL,
         phone VARCHAR(20) NOT NULL,
         active BOOLEAN NOT NULL DEFAULT 1,
         rating DECIMAL(3,1) NOT NULL,
         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
       )";
     if(!mysqli_query($connection, $query)) echo("<div class='alert alert-danger'>Erro ao criar tabela de fornecedores.</div>");
  }
}

function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);
  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");
  if(mysqli_num_rows($checktable) > 0) return true;
  return false;
}
?>