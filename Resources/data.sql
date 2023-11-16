-- info --
call userManagement(2, null, null, "'$username'", "'$password'", null, null, null, null, null, null, null, null)


-- inserts -- 

insert into rol (rol) values ('comprador')
insert into rol (rol) values ('vendedor')
insert into rol (rol) values ('admin')


-- views -- 

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


-----