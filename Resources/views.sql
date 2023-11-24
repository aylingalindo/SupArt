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
    p.stock 
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


CREATE VIEW vProductOverview AS
SELECT 
    a.productID as productID,
    a.stock as stock,
    a.name as name,
    a.description as description, 
    a.pricingType as pricingType,
    a.price as price, 
    a.review as review,
    a.approvedBy as approvedBy,
    a.uploadedBy as uploadedBy,
    a.category as category,
    CASE WHEN b.fileName = 'mp4'
    THEN null
    ELSE b.file END as file,
    CASE WHEN b.fileName = 'mp4'
    THEN null
    ELSE b.fileName END as fileName,
    CONCAT(c.name, ' ', c.lastnameP) as uploadedName
FROM products a
LEFT JOIN mediaFilesProducts b on a.productID = b.product
LEFT JOIN users c on a.uploadedBy = c.userID
group by a.productID


CREATE VIEW vProductDetails AS
SELECT
            a.productID
            ,a.stock
            ,a.name
            ,a.description
            ,a.pricingType
            ,a.price
            ,a.review
            ,a.approvedBy
            ,a.uploadedBy
            ,a.category
            ,b.name as categoryName
            ,CONCAT(c.name,' ',c.lastnameP) as uploadedByName
        FROM products a
        Left Join category b on  a.category = b.categoryID
        Left Join users c on a.uploadedBy = c.userID



CREATE VIEW vPopularesDashboardP as
Select 
            a.*,
            SUM(b.numItems) AS totalItemsSold
        From vProductOverview a
        Left Join purchaseInfo b on a.productID = b.product
        group by a.productID
        order by totalItemsSold DESC
        limit 15;


create view vcalifdashboardp as
Select *
        From vProductOverview
        order by review desc 
        limit 15;


