--8 views
CREATE VIEW chat AS
SELECT
    chat.messageID,
    chat.senderID,
    chat.receiverID,
    chat.message,
    product.productID,
    product.name
FROM
    usermessages chat
JOIN
    products product ON chat.product = product.productID;


CREATE VIEW SoldProducts AS
SELECT
    p.name AS productName,
    c.name AS category,
    p.uploadedBy AS sellerUserID,
    pu.user AS buyerUserID,
    m.file AS image,
    pu.folio,
    pu.purchaseDate,
    r.score AS review,
    pu.numItems,
    pu.total,
    p.stock,
    p.category as categoryID
FROM products p
JOIN purchaseinfo pu ON p.productID = pu.product
JOIN category c ON p.category = c.categoryID
LEFT JOIN mediafilesproducts m ON p.productID = m.product
LEFT JOIN reviews r ON pu.purchaseID = r.purchaseID;


CREATE VIEW GroupedSales AS
SELECT 
    p.category AS Category,
    p.sellerUserID AS SellerID,
    DATE_FORMAT(p.purchaseDate, '%M %Y') AS Date,
    COUNT(*) AS Sales
FROM SoldProducts p
GROUP BY Category, SellerID, YEAR(p.purchaseDate), MONTH(p.purchaseDate)
ORDER BY YEAR(p.purchaseDate), MONTH(p.purchaseDate);

CREATE VIEW UserCart AS
SELECT 
    cart.cartID, 
    cart.product, 
    cart.numItems, 
    cart.user,
    products.name,
    products.description,
    products.pricingType,
    products.price,
    products.review,
    category.name AS `category`,
    products.stock AS `totalStock`
FROM cart
JOIN products ON cart.product = products.productID
JOIN category ON products.category = category.categoryID;
