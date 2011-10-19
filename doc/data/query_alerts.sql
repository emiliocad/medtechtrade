SELECT 
usuario_id,
tipo,
detalle
FROM 
alerta 
WHERE 
	active = 1 AND tipo = 3
	UNION SELECT usuario_id,
tipo,
detalle
FROM alerta WHERE detalle IN (SELECT categoria_id FROM equipo WHERE id = 18)
UNION 
SELECT usuario_id,
1, NULL 
FROM busqueda 
WHERE 
'ecografia' LIKE CONCAT('%', busqueda.palabras_busqueda, '%') AND
'sdf' LIKE CONCAT('%', busqueda.modelo,'%') AND
'sansum' LIKE CONCAT('%', busqueda.fabricante,'%')
AND CASE busqueda.categoria_id WHEN -1 THEN busqueda.categoria_id LIKE '%%'ELSE '148'= busqueda.categoria_id END 
AND '1987' > busqueda.anio_inicio AND 
CASE busqueda.anio_fin WHEN -1 THEN busqueda.anio_fin LIKE '%%' ELSE '1987'< busqueda.anio_fin END AND 
CASE busqueda.precio_inicio WHEN -1 THEN busqueda.precio_inicio LIKE '%%' ELSE busqueda.precio_inicio < '15' END AND
CASE busqueda.precio_fin WHEN -1 THEN busqueda.precio_fin LIKE '%%' ELSE busqueda.precio_fin > '15' END AND
active = 1

