TODO -> in the products controller

when we add a product to the database, the featured_image and other_images is added
to the file storeage before all reacords are entered. If a transaction fails when adding
the new records, there will be a database rollback, but the images in he file storage will
not be deleted. Not an immediate issue right now but will have images with no use if
records not present.
