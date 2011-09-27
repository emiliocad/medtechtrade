SELECT 
                    equipo.id , equipo.nombre AS equipo , precioventa ,
                    preciocompra , calidad , modelo ,
                    fechafabricacion , documento , sourceDocumento ,
                    pesoEstimado ,
                    size ,
                    ancho ,
                    alto ,
                    sizeCaja ,
                    topofers ,
                    publishdate ,
                    equipo.active,
                    categoria.nombre AS categoria,
                    publicacionequipo.nombre AS publicacionequipo,
                    fabricantes.nombre AS fabricante,
                    moneda.nombre AS moneda,
                    paises.nombre AS paises,
                    estadoequipo.nombre AS estadoequipo,
                    imagen.imagen                    
FROM equipo

                INNER JOIN 
                        categoria ON categoria.id = equipo.categoria_id
                INNER JOIN
                        publicacionequipo ON publicacionequipo.id = equipo.publicacionEquipo_id
      
                INNER JOIN fabricantes ON fabricantes.id = equipo.fabricantes_id

                INNER JOIN moneda ON moneda.id = equipo.moneda_id

                INNER JOIN paises ON paises.id = equipo.paises_id
                   
                INNER JOIN estadoequipo
                             ON estadoequipo.id = equipo.estadoequipo_id
                LEFT JOIN imagen 
			ON imagen.equipo_id  = equipo.id                
       
                WHERE equipo.active = 1
                AND equipo.publicacionEquipo_id = 2
                AND equipo.usuario_id = 6
                GROUP BY (equipo.id)