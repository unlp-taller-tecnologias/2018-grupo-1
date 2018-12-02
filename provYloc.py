import requests
sql = open('./provincias.sql', mode='w', encoding='utf-8')
r = requests.get('https://apis.datos.gob.ar/georef/api/provincias')
provincias=r.json()['provincias']
i=0
for provincia in provincias:
    i+=1
    print(str(i)+'. '+provincia['nombre'])
    sql.write("INSERT INTO `provincia` (`id`,`nacion_id` ,`nombre`) VALUES ('"+provincia['id']+"', NULL, \""+provincia['nombre']+"\");"+'\n')
    #print("INSERT INTO provincia (id, nombre) VALUES ("+provincia['id']+", "+provincia['nombre']+");")
    l = requests.get('https://apis.datos.gob.ar/georef/api/municipios?provincia='+provincia['id']+'&max=500')
    localidades = l.json()['municipios']
    for localidad in localidades:
        #print("INSERT INTO localidad (id, nombre, provincia) VALUES ("+localidad['id']+", "+localidad['nombre']+", "+provincia['id']+");")
        sql.write("INSERT INTO `localidad` (`id`, `nombre`, `provincia_id`) VALUES ('"+localidad['id']+"', \""+localidad['nombre']+"\", '"+provincia['id']+"');"+'\n')
sql.close()
