SELECT 
equipo.id,
equipo.nombre AS equipo,
equipo.modelo,
equipo.fechafabricacion,
equipo.tag,
equipo.active,
equipo.preciocompra,
fabricantes.nombre AS fabricante,
categoria.id,
categoria.nombre AS categoria
FROM equipo
INNER JOIN fabricantes ON equipo.fabricantes_id = fabricantes.id
INNER JOIN categoria ON equipo.categoria_id = categoria.id
WHERE equipo.active = 1
AND 
equipo.nombre LIKE "%%" AND
equipo.modelo LIKE "%%" AND 
CASE -1 WHEN -1 THEN equipo.categoria_id LIKE '%%' ELSE equipo.categoria_id = 150 END AND
DATE_FORMAT(equipo.fechafabricacion,'%Y')  > -1 AND
CASE -1
	WHEN -1 
	THEN DATE_FORMAT(equipo.fechafabricacion,'%Y') < (DATE_FORMAT(NOW(),'%Y')+1) 
	ELSE DATE_FORMAT(equipo.fechafabricacion,'%Y')  < 2010 END AND
equipo.preciocompra > -1 AND
CASE 99999999 WHEN 99999999
	THEN equipo.preciocompra > -1
	ELSE equipo.preciocompra < 5000 END 
	
