<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get("/products/", function (Request $request, Response $response){
    $sql = "SELECT * FROM products";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get("/products/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "SELECT * FROM products WHERE product_id=:id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":id" => $id]);
    $result = $stmt->fetch();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get("/products/search/", function (Request $request, Response $response, $args){
    $keyword = $request->getQueryParam("keyword");
    $sql = "SELECT * FROM products WHERE name LIKE '%$keyword%' OR price LIKE '%$keyword%' OR amount LIKE '%$keyword%'OR type LIKE '%$keyword%'";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":id" => $id]);
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get("/products_expired/", function (Request $request, Response $response){
    $sql = "SELECT * FROM products WHERE expired < CURRENT_TIMESTAMP()";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});


$app->post("/products/", function (Request $request, Response $response){

    $new_product = $request->getParsedBody();

    $sql = "INSERT INTO products (name, price, amount, type, expired) VALUE (:name, :price, :amount, :type, :expired)";
    $stmt = $this->db->prepare($sql);

    $data = [
        ":name" => $new_product["name"],
        ":price" => $new_product["price"],
        ":amount" => $new_product["amount"],
        ":type" => $new_product["type"],
        ":expired" => $new_product["expired"]

    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});


$app->put("/products/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $new_product = $request->getParsedBody();
    $sql = "UPDATE products SET name=:name, price=:price, amount=:amount, type=:type WHERE product_id=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id,
        ":name" => $new_product["name"],
        ":price" => $new_product["price"],
        ":amount" => $new_product["amount"],
        ":type" => $new_product["type"]
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});


$app->delete("/products/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "DELETE FROM products WHERE product_id=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});

$app->get("/customers/", function (Request $request, Response $response){
    $sql = "SELECT * FROM customers";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get("/customers/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "SELECT * FROM customers WHERE customer_id=:id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":id" => $id]);
    $result = $stmt->fetch();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get("/customers/search/", function (Request $request, Response $response, $args){
    $keyword = $request->getQueryParam("keyword");
    $sql = "SELECT * FROM customers WHERE name LIKE '%$keyword%' OR address LIKE '%$keyword%' OR gender LIKE '%$keyword%'OR contact_person  LIKE '%$keyword%' ";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":id" => $id]);
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->post("/customers/", function (Request $request, Response $response){

    $new_customer = $request->getParsedBody();

    $sql = "INSERT INTO customers (name, address, gender, contact_person) VALUE (:name, :address, :gender, :contact_person)";
    $stmt = $this->db->prepare($sql);

    $data = [
        ":name" => $new_customer["name"],
        ":address" => $new_customer["address"],
        ":gender" => $new_customer["gender"],
        ":contact_person" => $new_customer["contact_person"]
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});

$app->put("/customers/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $new_employee = $request->getParsedBody();
    $sql = "UPDATE customers SET name=:name, address=:address, gender=:gender, contact_person=:contact_person  WHERE costumer_id=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id,
        ":name" => $new_employee["name"],
        ":address" => $new_employee["address"],
        ":gender" => $new_employee["gender"],
        ":contact_person" => $new_employee["contact_person"]
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});


$app->delete("/customers/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "DELETE FROM customers WHERE customer_id=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});

$app->get("/supplier/", function (Request $request, Response $response){
    $sql = "SELECT * FROM supplier";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get("/supplier/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "SELECT * FROM supplier WHERE supplier_id=:id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":id" => $id]);
    $result = $stmt->fetch();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get("/supplier/search/", function (Request $request, Response $response, $args){
    $keyword = $request->getQueryParam("keyword");
    $sql = "SELECT * FROM supplier WHERE name LIKE '%$keyword%' OR address LIKE '%$keyword%' OR contact_person LIKE '%$keyword%'OR item_supplied LIKE '%$keyword%'";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":id" => $id]);
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->post("/supplier/", function (Request $request, Response $response){

    $new_supplier = $request->getParsedBody();

    $sql = "INSERT INTO supplier (name, address, contact_person, item_supplied) VALUE (:name, :address, :contact_person, :item_supplied)";
    $stmt = $this->db->prepare($sql);

    $data = [
        ":name" => $new_supplier["name"],
        ":address" => $new_supplier["address"],
        ":contact_person" => $new_supplier["contact_person"],
        ":item_supplied" => $new_supplier["item_supplied"]
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});


$app->put("/supplier/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $new_supplier = $request->getParsedBody();
    $sql = "UPDATE supplier SET name=:name, address=:address, contact_person=:contact_person, item_supplied=:item_supplier  WHERE supplier_id=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id,
        ":name" => $new_supplier["name"],
        ":address" => $new_supplier["address"],
        ":contact_person" => $new_supplier["contact_person"],
        ":item_supplied" => $new_supplier["item_supplied"]
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});


$app->delete("/supplier/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "DELETE FROM supplier WHERE supplier_id=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});

$app->get("/transactions/", function (Request $request, Response $response){
    $sql = "SELECT * FROM transactions";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get("/transactions/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "SELECT * FROM transactions WHERE transaction_id=:id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":id" => $id]);
    $result = $stmt->fetch();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get("/transactions/search/", function (Request $request, Response $response, $args){
    $keyword = $request->getQueryParam("keyword");
    $sql = "SELECT * FROM transactions WHERE customer LIKE '%$keyword%' OR product LIKE '%$keyword%' OR date LIKE '%$keyword%'OR amount LIKE '%$keyword%'OR price LIKE '%$keyword%'";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":id" => $id]);
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

    $app->post("/transactions/", function (Request $request, Response $response){

        $new_transaction = $request->getParsedBody();
    
        $sql = "INSERT INTO transactions (customer, product, date, amount, price) VALUE (:customer, :product, :date, :amount, :price )";
        $stmt = $this->db->prepare($sql);
        $sql2 ="";
        
    
        $data = [
            ":customer" => $new_transaction ["customer"],
            ":product" => $new_transaction ["product"],
            ":date" => $new_transaction ["date"],
            ":amount" => $new_transaction ["amount"],
            ":price" => $new_transaction ["price"]
        
        ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});


$app->put("/transactions/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $new_transaction = $request->getParsedBody();
    $sql = "UPDATE transactions SET customer=:customer, product=:product, date=:date, amount=:amount, price=:price  WHERE transaction_id=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id,
        ":customer" => $new_transaction ["customer"],
        ":product" => $new_transaction ["product"],
        ":date" => $new_transaction ["date"],
        ":amount" => $new_transaction ["amount"],
        ":price" => $new_transaction ["price"]
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});


$app->delete("/transactions/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "DELETE FROM transactions WHERE transaction_id=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});

