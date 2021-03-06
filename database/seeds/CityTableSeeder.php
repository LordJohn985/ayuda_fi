<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{

    public function run()
    {

        $array_cities=["25 de Mayo Misiones",
            "28 de Noviembre Santa Cruz",
            "2 de Mayo Misiones",
            "Abra Pampa Jujuy",
            "Achiras Cordoba",
            "Aconquija Catamarca",
            "Adolfo Gonzales Chaves Buenos Aires",
            "Aguas Calientes Jujuy",
            "Aguas de Oro Cordoba",
            "Aguas Verdes Buenos Aires",
            "Aimogasta La Rioja",
            "Alba Posse Misiones",
            "Alberdi Tucuman",
            "Alberti Buenos Aires",
            "Alcira Gigena Cordoba",
            "Alejandra Santa Fe",
            "Alijilan Catamarca",
            "Allen Rio Negro",
            "Almafuerte Cordoba",
            "Alpa Corral Cordoba",
            "Alta Gracia Cordoba",
            "Alto Rio Senguer Chubut",
            "Alumine Neuquen",
            "Amaicha del Valle Tucuman",
            "Amboy Cordoba",
            "Aminga La Rioja",
            "Ampimpa Tucuman",
            "Añatuya Santiago del Estero",
            "Ancasti Catamarca",
            "Andacollo Neuquen",
            "Andalgala Catamarca",
            "Andresito Misiones",
            "Angastaco Salta",
            "Anillaco La Rioja",
            "Anisacate Cordoba",
            "Antofagasta Catamarca",
            "Apostoles Misiones",
            "Arenas Verdes Buenos Aires",
            "Aristobulo del Valle Misiones",
            "Armstrong Santa Fe",
            "Arocena Santa Fe",
            "Arrecifes Buenos Aires",
            "Arroyito Cordoba",
            "Arroyito Neuquen",
            "Arroyo de los Patos Cordoba",
            "Arroyo Leyes Santa Fe",
            "Arroyo Seco Santa Fe",
            "Ascochinga Cordoba",
            "Ataliva Roca La Pampa",
            "Athos Pampa Cordoba",
            "Avellaneda Santa Fe",
            "Avia Terai Chaco",
            "Ayacucho Buenos Aires",
            "Azul Buenos Aires",
            "Bahia Blanca Buenos Aires",
            "Bahía Bustamante Chubut",
            "Bahia San Blas Buenos Aires",
            "Balcarce Buenos Aires",
            "Balde San Luis",
            "Balnearia Cordoba",
            "Balneario San Cayetano Buenos Aires",
            "Bandera Santiago del Estero",
            "Baradero Buenos Aires",
            "Bariloche Rio Negro",
            "Barrancas Santa Fe",
            "Barreal San Juan",
            "Basavilbaso Entre Rios",
            "Belen Catamarca",
            "Bella Vista Corrientes",
            "Bella Vista San Juan",
            "Bell Ville Cordoba",
            "Benito Juarez Buenos Aires",
            "Berisso, Buenos Aires",
            "Bernardo de Irigoyen Misiones",
            "Bernardo Larroude La Pampa",
            "Bialet Masse Cordoba",
            "Bolivar Buenos Aires",
            "Bragado Buenos Aires",
            "Brandsen Buenos Aires",
            "Brazo Largo Entre Rios",
            "Burruyacu Tucuman",
            "Caa Cati Corrientes",
            "Cabalango Cordoba",
            "Cabra Corral Salta",
            "Cachi Salta",
            "Cafayate Salta",
            "Caimancito Jujuy",
            "Caleta Olivia Santa Cruz",
            "Calingasta San Juan",
            "Calmayo Cordoba",
            "Camarones Chubut",
            "Campana Buenos Aires",
            "Campo Grande Misiones",
            "Campo Quijano Salta",
            "Campo Viera Misiones",
            "Candelaria Misiones",
            "Cañon del Atuel Mendoza",
            "Cañuelas Buenos Aires",
            "Capilla del Monte Cordoba",
            "Capilla del Señor Buenos Aires",
            "Capiovi Misiones",
            "Ciudad Autonoma de Buenos Aires Buenos Aires",
            "Capitan Sarmiento Buenos Aires",
            "Caraguatay Misiones",
            "Carcaraña Santa Fe",
            "Carhue Buenos Aires",
            "Carilo Buenos Aires",
            "Carlos Casares Buenos Aires",
            "Carlos Keen Buenos Aires",
            "Carlos Tejedor Buenos Aires",
            "Carmen de Areco Buenos Aires",
            "Carmen de Patagones Buenos Aires",
            "Carpinteria San Luis",
            "Carro Quemado La Pampa",
            "Casabindo Jujuy",
            "Casa de Piedra La Pampa",
            "Casa Grande Cordoba",
            "Casilda Santa Fe",
            "Castelli Buenos Aires",
            "Catriel Rio Negro",
            "Caucete San Juan",
            "Caviahue Neuquen",
            "Cayasta Santa Fe",
            "Cañada de Gomez Santa Fe",
            "Concepcion del Uruguay Entre Rios",
            "Centenario Neuquen",
            "Ceres Santa Fe",
            "Cerrillos Salta",
            "Cerro Colorado Cordoba",
            "Chabas Santa Fe",
            "Chacabuco Buenos Aires",
            "Chacarramendi La Pampa",
            "Chacras de Coria Mendoza",
            "Chajari Entre Rios",
            "Chamical La Rioja",
            "Chapadmalal Buenos Aires",
            "Charata Chaco",
            "Charbonier Cordoba",
            "Chascomus Buenos Aires",
            "Chepes La Rioja",
            "Chicoana Salta",
            "Chilecito La Rioja",
            "Chivilcoy Buenos Aires",
            "Choele Choel Rio Negro",
            "Cholila Chubut",
            "Chos Malal Neuquen",
            "Cinco Saltos Rio Negro",
            "Cipolletti Rio Negro",
            "Claromeco Buenos Aires",
            "Clorinda Formosa",
            "Colalao del Valle Tucuman",
            "Colon Entre Rios",
            "Colon Buenos Aires",
            "Colonia 25 de Mayo La Pampa",
            "Colonia Baron La Pampa",
            "Colonia Caroya Cordoba",
            "Colonia Suiza Mendoza",
            "Colonia Victoria Misiones",
            "Comandante Piedra Buena Santa Cruz",
            "Comodoro Rivadavia Chubut",
            "Concaran San Luis",
            "Concepcion Tucuman",
            "Concepcion de la Sierra Misiones",
            "Concordia Entre Rios",
            "Copacabana Cordoba",
            "Copahue Neuquen",
            "Corcovado Chubut",
            "Cordoba Capital Cordoba",
            "Coronda Santa Fe",
            "Coronel Dorrego Buenos Aires",
            "Coronel Moldes Salta",
            "Coronel Pringles Buenos Aires",
            "Coronel Suarez Buenos Aires",
            "Coronel Vidal Buenos Aires",
            "Corpus Misiones",
            "Corrientes Capital Corrientes",
            "Cortaderas San Luis",
            "Cosquin Cordoba",
            "Costa Azul Buenos Aires",
            "Costa Chica Buenos Aires",
            "Costa del Este Buenos Aires",
            "Costa Esmeralda Buenos Aires",
            "Colonia Pellegrini Corrientes",
            "Crespo Entre Rios",
            "Cruz Alta Cordoba",
            "Cruz Chica Cordoba",
            "Cruz del Eje Cordoba",
            "Cruz Grande Cordoba",
            "Cuesta Blanca Cordoba",
            "Curuzu Cuatia Corrientes",
            "Cutral Co Neuquen",
            "Daireaux Buenos Aires",
            "Dean Funes Cordoba",
            "Del Campillo Cordoba",
            "Despeñaderos Cordoba",
            "Desvio Arijon Santa Fe",
            "Diamante Entre Rios",
            "Dina Huapi Río Negro",
            "Dolores Buenos Aires",
            "Eduardo Castex La Pampa",
            "El Alcazar Misiones",
            "El Alto Catamarca",
            "El Bolson Rio Negro",
            "El Cadillal Tucuman",
            "El Calafate Santa Cruz",
            "El Carmen Jujuy",
            "El Chalten Santa Cruz",
            "El Cholar Neuquen",
            "El Colorado Formosa",
            "El Dorado Misiones",
            "El Durazno Cordoba",
            "El Hoyo Chubut",
            "El Huecu Neuquen",
            "El Maiten Chubut",
            "El Manso Rio Negro",
            "El Manzano Cordoba",
            "El Mollar Tucuman",
            "El Morro San Luis",
            "El Nihuil Mendoza",
            "Elortondo Santa Fe",
            "El Rodeo Catamarca",
            "El Sauzalito Chaco",
            "El Siambon Tucuman",
            "El Soberbio Misiones",
            "El Sosneado Mendoza",
            "El Trapiche San Luis",
            "El Volcan San Luis",
            "Embalse Cordoba",
            "Embarcacion Salta",
            "Empedrado Corrientes",
            "Ensenada Buenos Aires",
            "Epuyen Chubut",
            "Escobar Buenos Aires",
            "Esperanza Santa Fe",
            "Esquel Chubut",
            "Esquina Corrientes",
            "Exaltacion de la Cruz Buenos Aires",
            "Ezeiza Buenos Aires",
            "Famailla Tucuman",
            "Famatina La Rioja",
            "Federacion Entre Rios",
            "Federal Entre Rios",
            "Florentino Ameghino Buenos Aires",
            "Fiambala Catamarca",
            "Firmat Santa Fe",
            "Fitz Roy Santa Cruz",
            "Jaramillo Santa Cruz",
            "Florencia Santa Fe",
            "Formosa Capital Formosa",
            "Franck Santa Fe",
            "Frias Santiago del Estero",
            "Fuerte Esperanza Chaco",
            "Funes Santa Fe",
            "Gaiman Chubut",
            "Gancedo Chaco",
            "Garupa Misiones",
            "Gobernador Gregores Santa Cruz",
            "General Acha La Pampa",
            "General Alvear Mendoza",
            "General Belgrano Buenos Aires",
            "General Conesa Rio Negro",
            "General Deheza Cordoba",
            "General Guemes Salta",
            "General Lamadrid Buenos Aires",
            "General Las Heras Buenos Aires",
            "General Lavalle Buenos Aires",
            "General Levalle Cordoba",
            "General Madariaga Buenos Aires",
            "General Manuel Belgrano Formosa",
            "General Mosconi Salta",
            "General Pico La Pampa",
            "General Pinedo Chaco",
            "General Pinto Buenos Aires",
            "General Ramirez Entre Rios",
            "General Roca Rio Negro",
            "General Rodriguez Buenos Aires",
            "General San Martin Chaco",
            "General Vedia Chaco",
            "General Villegas Buenos Aires",
            "Gobernador Costa Chubut",
            "Gobernador Roca Misiones",
            "Godoy Cruz Mendoza",
            "Goya Corrientes",
            "General San Martin La Pampa",
            "Granadero Baigorria Santa Fe",
            "General Ramirez Entre Rios",
            "Gualeguaychu Entre Rios",
            "Guamini Buenos Aires",
            "Guandacol La Rioja",
            "Guatrache La Pampa",
            "Guaymallen Mendoza",
            "Hasenkamp Entre Rios",
            "Helvecia Santa Fe",
            "Hermoso Campo Chaco",
            "Hernandarias Entre Rios",
            "Hernando Cordoba",
            "Herradura Formosa",
            "Hipolito Yrigoyen Santa Cruz",
            "Hornillos Jujuy",
            "Huacalera Jujuy",
            "Huanguelen Buenos Aires",
            "Huerta Grande Cordoba",
            "Huichaira Jujuy",
            "Huinca Renanco Cordoba",
            "Huinganco Neuquen",
            "Humahuaca Jujuy",
            "Ibarreta Formosa",
            "Ibicuy Entre Rios",
            "Icaño Catamarca",
            "Icho Cruz Cordoba",
            "Iglesia San Juan",
            "Ingeniero Jacobacci Rio Negro",
            "Ingeniero Juarez Formosa",
            "Intendente Alvear La Pampa",
            "Intiyaco Cordoba",
            "Iruya Salta",
            "Ischilin Cordoba",
            "Isla del Cerrito Chaco",
            "Ita Ibate Corrientes",
            "Itati Corrientes",
            "Ituzaingo Corrientes",
            "Jachal San Juan",
            "Jacinto Arauz La Pampa",
            "James Craik Cordoba",
            "Jardin America Misiones",
            "Jesus Maria Cordoba",
            "Joaquin V. Gonzalez Salta",
            "Jose de San Martin Chubut",
            "Juana Koslay San Luis",
            "Juan Jose Castelli Chaco",
            "Junin Buenos Aires",
            "Junin de los Andes Neuquen",
            "Junin Mendoza",
            "La Banda Santiago del Estero",
            "La Bolsa Cordoba",
            "Laboulaye Cordoba",
            "La Caldera Salta",
            "La Calera Cordoba",
            "La Carlota Cordoba",
            "La Carolina San Luis",
            "La Cesira Cordoba",
            "La Cruz Cordoba",
            "La Cruz Corrientes",
            "La Cumbre Cordoba",
            "La Cumbrecita Cordoba",
            "La Falda Cordoba",
            "La Florida San Luis",
            "Lago Puelo Chubut",
            "La Granja Cordoba",
            "Laguna Blanca Formosa",
            "La Lucila del Mar Buenos Aires",
            "La Paisanita Cordoba",
            "La Paz Entre Rios",
            "La Paz Catamarca",
            "La Paz Cordoba Cordoba",
            "La Plata Buenos Aires",
            "La Poblacion Cordoba",
            "La Poma Salta",
            "La Puerta Catamarca",
            "La Punta San Luis",
            "La Quiaca Jujuy",
            "La Rioja Capital La Rioja",
            "Larroque Entre Rios",
            "Las Albacas Cordoba",
            "Las Breñas Chaco",
            "Las Caleras Cordoba",
            "Las Calles Cordoba",
            "Las Carditas Mendoza",
            "Las Cuevas Mendoza",
            "La Serranita Cordoba",
            "Las Flores San Juan",
            "Las Flores Buenos Aires",
            "Las Gaviotas Buenos Aires",
            "Las Grutas Rio Negro",
            "Las Heras Mendoza",
            "Las Heras Santa Cruz",
            "Las Juntas Catamarca",
            "Las Lajas Neuquen",
            "Las Lomitas Formosa",
            "Las Ovejas Neuquen",
            "Las Rabonas Cordoba",
            "Las Tapias Cordoba",
            "Las Toninas Buenos Aires",
            "Las Vegas Mendoza",
            "La Toma San Luis",
            "Leandro Alem Misiones",
            "Libertador San Martin Jujuy",
            "Lincoln Buenos Aires",
            "Loberia Buenos Aires",
            "Lobos Buenos Aires",
            "Loma Bola Cordoba",
            "Loncopue Neuquen",
            "Loreto Misiones",
            "Los Antiguos Santa Cruz",
            "Los Cocos Cordoba",
            "Los Condores Cordoba",
            "Los Hornillos Cordoba",
            "Los Menucos Rio Negro",
            "Los Molinos Cordoba",
            "Los Molles San Luis",
            "Los Molles Mendoza",
            "Los Pozos Cordoba",
            "Los Reartes Cordoba",
            "Los Reyunos Mendoza",
            "Los Toldos Buenos Aires",
            "Loza Corral Cordoba",
            "Lozano Jujuy",
            "Lujan Buenos Aires",
            "Lujan de Cuyo Mendoza",
            "Lujan San Luis",
            "Macachin La Pampa",
            "Machagai Chaco",
            "Magdalena Buenos Aires",
            "Maimara Jujuy",
            "Maipu Mendoza",
            "Maipu Buenos Aires",
            "Malargue Mendoza",
            "Manzano Amargo Neuquen",
            "Manzano Historico Mendoza",
            "Mar Azul Buenos Aires",
            "Mar Chiquita Buenos Aires",
            "Marcos Juarez Cordoba",
            "Mar de Ajo Buenos Aires",
            "Mar de Cobo Buenos Aires",
            "Mar de las Pampas Buenos Aires",
            "Mar del Plata Buenos Aires",
            "Mar del Sur Buenos Aires",
            "Mar del Tuyu Buenos Aires",
            "Maria Grande Entre Rios",
            "Marisol Buenos Aires",
            "Mayor Villafañe Formosa",
            "Mayu Sumaj Cordoba",
            "Mburucuya Corrientes",
            "Medanos Buenos Aires",
            "Melincue Santa Fe",
            "Mendiolaza Cordoba",
            "Mendoza Capital Mendoza",
            "Mercedes Corrientes",
            "Mercedes Buenos Aires",
            "Merlo San Luis",
            "San Jose de Metan Salta",
            "Mina Clavero Cordoba",
            "Ministro Ramos Mexia Rio Negro",
            "Miramar Buenos Aires",
            "Miramar Cordoba",
            "Mision Nueva Pompeya Chaco",
            "Molinari Cordoba",
            "Molinos Salta",
            "Monje Santa Fe",
            "Montecarlo Misiones",
            "Monte Caseros Corrientes",
            "Monte Hermoso Buenos Aires",
            "Monte Maiz Cordoba",
            "Moquehue Neuquen",
            "Morteros Cordoba",
            "Navarro Buenos Aires",
            "Necochea Buenos Aires",
            "Neuquen Capital Neuquen",
            "Nogoli San Luis",
            "Nueva Galia San Luis",
            "Nogoya Entre Rios",
            "Nono Cordoba",
            "Nueva Atlantis Buenos Aires",
            "Nueve de Julio Buenos Aires",
            "Obera Misiones",
            "Olavarria Buenos Aires",
            "Oliveros Santa Fe",
            "Olta La Rioja",
            "Oncativo Cordoba",
            "Ongamira Cordoba",
            "Oran Salta",
            "Orense Buenos Aires",
            "Oriente Buenos Aires",
            "Ostende Buenos Aires",
            "Paclin Catamarca",
            "Pagancillo La Rioja",
            "Palo Santo Formosa",
            "Palpala Jujuy",
            "Pampa del Indio Chaco",
            "Panaholma Cordoba",
            "Panambi Misiones",
            "Papagayos San Luis",
            "Parana Entre Rios",
            "Paso de la Patria Corrientes",
            "Paso de los Libres Corrientes",
            "Patquia La Rioja",
            "Pedro Luro Buenos Aires",
            "Pehuajo Buenos Aires",
            "Pehuen Co Buenos Aires",
            "Pergamino Buenos Aires",
            "Perico Jujuy",
            "Perito Moreno Santa Cruz",
            "Pico Truncado Santa Cruz",
            "Picun Leufu Neuquen",
            "Piedra del Aguila Neuquen",
            "Piedras Blancas Entre Rios",
            "Pigue Buenos Aires",
            "Pilar Buenos Aires",
            "Pinamar Buenos Aires",
            "Pinar del Sol Buenos Aires",
            "Pinto Santiago del Estero",
            "Pipinas Buenos Aires",
            "Pirane Formosa",
            "Pismanta San Juan",
            "Playas Doradas Rio Negro",
            "Playa Unión Chubut",
            "Plaza Huincul Neuquen",
            "Plottier Neuquen",
            "Poman Catamarca",
            "Posadas Misiones",
            "Potrerillos Mendoza",
            "Potrero de Garay Cordoba",
            "Potrero de los Funes San Luis",
            "Primeros Pinos Neuquen",
            "Puan Buenos Aires",
            "Pueblo Liebig Entre Rios",
            "Puerto Deseado Santa Cruz",
            "Puerto Esperanza Misiones",
            "Puerto Gaboto Santa Fe",
            "Puerto Iguazu Misiones",
            "Puerto Libertad Misiones",
            "Puerto Madryn Chubut",
            "Puerto Mineral Misiones",
            "Puerto Piramides Chubut",
            "Puerto Piray Misiones",
            "Puerto Rico Misiones",
            "Puerto San Julian Santa Cruz",
            "Puerto Santa Cruz Santa Cruz",
            "Puerto Tirol Chaco",
            "Puerto Yerua Entre Rios",
            "Puiggari Entre Rios",
            "Pulmari Neuquen",
            "Punta Alta Buenos Aires",
            "Punta Indio Buenos Aires",
            "Punta Medanos Buenos Aires",
            "Purmamarca Jujuy",
            "Quequen Buenos Aires",
            "Quilino Cordoba",
            "Quilmes Buenos Aires",
            "Quines San Luis",
            "Raco Tucuman",
            "Rada Tilly Chubut",
            "Rafaela Santa Fe",
            "Ramallo Buenos Aires",
            "Ranchos Buenos Aires",
            "Rancul La Pampa",
            "Rauch Buenos Aires",
            "Rawson Chubut",
            "Rawson",
            "Realico",
            "Reconquista",
            "Recreo",
            "Renca",
            "Resistencia",
            "Reta",
            "Rincón de los Sauces",
            "Rio Ceballos",
            "Rio Colorado",
            "Rio Cuarto",
            "Rio de los Sauces",
            "Rio Gallegos",
            "Rio Grande",
            "Rio Mayo",
            "Rio Pico",
            "Rio Tercero",
            "Rio Turbio",
            "Rivadavia",
            "Rivadavia",
            "Rivadavia",
            "Rodeo",
            "Rojas",
            "Romang",
            "Roque Perez",
            "Roque Saenz Peña",
            "Rosario",
            "Rosario de la Frontera",
            "Rosario del Tala",
            "Rufino",
            "Ruinas de Quilmes",
            "aavedra",
            "Saladillo",
            "Saldan",
            "Saldungaray",
            "Salsacate",
            "Salsipuedes",
            "Salta Capital",
            "Salto",
            "Salto Encantado",
            "Sanagasta",
            "San Andres de Giles",
            "San Antonio",
            "San Antonio de Apipe",
            "San Antonio de Areco",
            "San Antonio de Arredondo",
            "San Antonio de los Cobres",
            "San Antonio Este",
            "San Antonio Oeste",
            "San Bernardo",
            "San Blas de Los Sauces",
            "San Carlos",
            "San Carlos",
            "San Carlos Minas",
            "San Carlos",
            "San Cayetano",
            "San Clemente",
            "San Clemente del Tuyu",
            "San Cristobal",
            "San Esteban",
            "San Fernando",
            "San Fernando del Valle",
            "San Francisco",
            "San Francisco de Laishi",
            "S. Francisco del Monte",
            "San Francisco",
            "San Geronimo",
            "San Ignacio",
            "San Isidro",
            "San Isidro",
            "San Javier",
            "San Javier",
            "San Javier",
            "San Javier Tuc.",
            "San Jorge",
            "San Jose",
            "San Jose de Feliciano",
            "San Jose de la Dormida",
            "San Jose del Rincon",
            "San Juan Capital",
            "San Justo",
            "San Lorenzo",
            "San Luis Capital",
            "San Marcos Sierras",
            "San Martin",
            "San Martin de los Andes",
            "San Miguel de Tucuman",
            "San Miguel del Monte",
            "San Nicolas",
            "San Pedro",
            "San Pedro de Colalao",
            "San Pedro de Jujuy",
            "San Pedro",
            "San Rafael",
            "San Roque",
            "San Salvador",
            "San Salvador de Jujuy",
            "Santa Ana",
            "Santa Ana",
            "Santa Catalina",
            "Santa Clara del Mar",
            "Santa Cruz del Lago",
            "Santa Elena",
            "Santa Fe Capital",
            "Santa Isabel",
            "Santa Lucia",
            "Santa Maria",
            "Santa Maria de Punilla",
            "Santa María",
            "Santa Monica",
            "Santa Rita",
            "Santa Rosa Calamuchita",
            "Santa Rosa de Calchines",
            "Santa Rosa del Conlara",
            "Santa Rosa La Pampa",
            "Santa Rosa",
            "Santa Teresita",
            "Santa Teresita",
            "Santiago del Estero Capital",
            "Santo Tome",
            "Santo Tome Corrientes",
            "San Vicente",
            "Sarmiento",
            "Sastre",
            "Sauce",
            "Sauce Viejo",
            "Saujil",
            "Seclantas",
            "Sierra Colorada",
            "Sierra de las Quijadas",
            "Sierra de la Ventana",
            "Sierra de los Padres",
            "Sierra Grande",
            "Sierras Bayas",
            "Simoca",
            "Sinsacate",
            "Suipacha",
            "Sumampa",
            "Sunchales",
            "Susques",
            "aco Ralo",
            "Tafi del Valle",
            "Tafi Viejo",
            "Tala Huasi",
            "Tama",
            "Tancacha",
            "Tandil",
            "Tanti",
            "Tapalque",
            "Tartagal",
            "Termas de Rio Hondo",
            "Tigre",
            "Tilcara",
            "Tilisarao",
            "Timbues",
            "Tinogasta",
            "Toay",
            "Tobuna",
            "Tolar Grande",
            "Tolhuin",
            "Tomas Jofre",
            "Tornquist",
            "Tostado",
            "Treinta de Agosto",
            "Trelew",
            "Trenque Lauquen",
            "Tres Arroyos",
            "Trevelin",
            "Tricao Malal",
            "Tudcum",
            "Tumbaya",
            "Tunuyan",
            "Tupungato",
            "lapes",
            "Ullum",
            "Unquillo",
            "Uquia",
            "Urdinarrain",
            "Ushuaia",
            "Uspallata",
            "alcheta",
            "Valeria del Mar",
            "Vallecito",
            "Valle de Uco",
            "Valle Fertil",
            "Valle Grande",
            "Valle Grande",
            "Valle Hermoso",
            "Valle Maria",
            "Vaqueros",
            "Varvarco",
            "Vedia",
            "Veinticinco de Mayo",
            "Venado Tuerto",
            "Verónica",
            "Viale",
            "Vicente Casares",
            "Victoria",
            "Victorica",
            "Viedma",
            "Villa Allende",
            "Villa Alpina",
            "Villa Ameghino",
            "Villa Angela",
            "Villa Animi",
            "Villa Ascasubi",
            "Villa Berna",
            "Villa Cañas",
            "Villa Carlos Paz",
            "Villa Castelli",
            "Villa Ciudad America",
            "V. C. Parque Los Reartes",
            "Villa Constitucion",
            "Villa Cura Brochero",
            "Villa de la Quebrada",
            "Villa de las Rosas",
            "Villa del Dique",
            "Villa del Totoral",
            "Villa de Maria",
            "Villa de Soto",
            "Villa Dolores",
            "Villa El Chocon",
            "Villa El Condor",
            "Villa Elena",
            "Villa Elisa",
            "Villa Futalaufquen",
            "Villa General Belgrano",
            "Villa Gesell",
            "Villa Giardino",
            "Villaguay",
            "Villa Jardín de Reyes",
            "Villa La Angostura",
            "Villa La Arcadia",
            "Villa Lago Gutiérrez",
            "Villa Lago Mascardi",
            "Villa Lago Meliquina",
            "Villa La Punta",
            "Villa Larca",
            "Villa Las Pirquitas",
            "Villalonga",
            "Villa Los Aromos",
            "Villa Maria",
            "Villa Mercedes",
            "Villamonte",
            "Villa Nougues",
            "Villa Ocampo",
            "Villa Ojo de Agua",
            "Villa Paranacito",
            "Villa Parque Siquiman",
            "Villa Pehuenia",
            "Villa Regina",
            "Villa Rio Bermejito",
            "Villa Rumipal",
            "Villa San Lorenzo",
            "Villa Serrana La Gruta",
            "Villa Traful",
            "Villa Tulumba",
            "Villa Union",
            "Villa Urquiza",
            "Villa Ventana",
            "Villa Yacanto",
            "Vinchina",
            "Virasoro",
            "Volcan",
            "anda",
            "Winifreda",
            "acanto",
            "Yala",
            "Yapeyu",
            "Yavi",
            "Yerba Buena",
            "apala",
            "Zarate",
            "Zonda"];


        foreach ($array_cities as $city){

            App\City::create(['name' => $city]);

        }



    }

}
