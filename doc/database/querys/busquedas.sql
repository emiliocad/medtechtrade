SELECT palabras_busqueda,
modelo,
fabricante,
categoria_id,
CASE anio_inicio WHEN -1 THEN '' ELSE anio_inicio END AS anio_inicio,
CASE anio_fin WHEN -1 THEN '' ELSE anio_fin END AS anio_fin,
CASE precio_inicio WHEN -1 THEN '' ELSE precio_inicio END AS precio_inicio,
CASE precio_fin WHEN -1 THEN '' ELSE precio_fin END precio_fin,
usuario_id,
CASE categoria_id WHEN -1 THEN "Todos" ELSE (SELECT nombre FROM categoria WHERE categoria.id = categoria_id) END AS categoria
FROM busqueda
WHERE usuario_id = 6