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