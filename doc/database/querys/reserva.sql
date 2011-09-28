SELECT reserva.id,
reserva.equipo_id,
fechagrabacion, 
reserva.order,
equipo.nombre,
equipo.precioventa,
equipo.categoria_id,
categoria.nombre AS categoria,
equipo.tag,
equipo.modelo,
imagen.descripcion,
imagen.imagen,
imagen.nombre
FROM  reserva
INNER JOIN equipo ON equipo.id = reserva.equipo_id
INNER JOIN categoria ON equipo.categoria_id = categoria.id
LEFT JOIN imagen ON reserva.equipo_id = imagen.equipo_id
WHERE reserva.usuario_id = 6
AND reserva.active = 1
AND reserva.tipo_reserva_id = 2
GROUP BY (equipo.id)
