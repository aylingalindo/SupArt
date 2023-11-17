--8 views
CREATE VIEW chat AS
SELECT
    chat.messageID,
    chat.senderID,
    chat.receiverID,
    chat.message,
    chat.product,
    product.productID,
    product.name,
FROM
    usermessages chat
JOIN
    products product ON chat.product = product.productID;


CREATE VIEW SoldProducts AS
SELECT
    p.name AS productName,
    p.description AS productDescription,
    pu.purchaseDate,
    p.uploadedBy AS sellerUserID,
    pu.user AS buyerUserID,
    pu.total,
    pu.numItems
FROM products p
JOIN purchaseinfo pu ON p.productID = pu.product;

