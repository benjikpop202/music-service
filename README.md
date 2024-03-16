Nombre del trabajo
Music Service


Tipo de Documento 
Análisis de Requerimientos
A quién está dirigido
Está dirigido a Clientes que tengan la necesidad de crear listas con sus canciones predilectas.
Resumen
El programa, apunta a ser una plataforma dinámica y sencilla para manipular los objetos estipulados, donde los mismos podrán ser buscados, almacenados y listados según las necesidades y requerimientos de cada Cliente.
Fecha
Autor/es
Versión Documento
Versión Software
marzo/2024
Sobarzo Benjamin/Piriz Gustavo
1.1





Entrevista con el cliente
El cliente nos pide una aplicación para crear listas que puedan guardar sus canciones favoritas para escucharlas en cualquier momento, y poder dividir sus listas en varias secciones según le parezca. por ejemplo una lista se puede llamar: Música de entrenamiento, Estudio, Electro, Clásicos de los 80 etc.
También sugieren poder compartir sus listas al público para que otras personas puedan escucharlas.


Requerimientos del Sistema

Los Usuarios primero deben Registrarse para usar nuestra app, y tendrán la opción de elegir la versión gratuita o Premium.
La versión Gratuita solo permitirá a los usuarios cargar sus canciones en sus listas personales y poder escuchar también las listas de la plataforma. Esta versión también incluye anuncios.
En la versión premium al usuario se le cobrará 4,50 dólares al mes y se podrá cobrar con tarjeta de crédito o débito. En esta versión los usuarios aparte de poder cargar sus listas personales también tendrán la opción de poder subirlas a la plataforma para que sean públicas a todos los usuarios del sistema.
El sistema tendrá un menú principal donde está la opción de crear nueva lista y esta se almacenará en la biblioteca del usuario. Dentro de la lista está la opción de agregar canciones y eliminar canciones. también el sistema tendrá una plataforma donde se cargaran las listas subidas por los usuarios premium y estas podrán ser accedidas por cualquier usuario del sistema.
Las listas pueden ser públicas o privadas, las públicas son las compartidas en la plataforma y las privadas son las listas personales de cada persona. Cada una tiene que tener un nombre y pueden almacenar hasta 60 canciones.
Las canciones tienen que tener un nombre, artista, género y fecha de lanzamiento.
*Nuestro negocio se basa en las suscripciones y anuncios del sistema






 Nuevas Funciones solicitadas por el cliente:

El cliente solicitó que se incorporen 2 opciones a la aplicación de Music-Service, las mismas realizaran la siguiente operación.
1. El usuario podrá crear Listas Genéricas, ahora pasamos a detallar su funcionamiento.
Verificación de estado premium: Primero, verifica si el usuario es premium. Si lo es, continúa con la creación de la lista. Si no lo es, muestra un mensaje indicando que la opción es exclusiva para usuarios premium.
Ingreso de datos: Le pide al usuario que ingrese un nombre para la lista y el género musical que desea. Estos datos son importantes para personalizar la lista de reproducción.
Creación de la lista: Una vez que el usuario proporciona el nombre y el género, se guarda una nueva lista en la base de datos con ese nombre y se asocia con el usuario. También se obtienen canciones de la base de datos que coincidan con el género musical ingresado.
Selección de canciones: Se seleccionan aleatoriamente hasta 5 canciones que coincidan con el género musical ingresado. Estas canciones se copian en la lista recién creada.
Mostrar lista creada: Finalmente, se muestra un mensaje al usuario indicando que la lista ha sido creada exitosamente.
En resumen, esta función permite a los usuarios premium crear listas de reproducción genéricas personalizadas basadas en un género musical de su elección.




2. Función para Combinar 2 Listas: 


Esta función toma dos listas de reproducción existentes y las combina en una nueva lista. Aquí está cómo funciona:
Verificación de las listas: Primero, verifica si las dos listas que se van a combinar están en la biblioteca del usuario. Si alguna de las listas no se encuentra, no se puede realizar la combinación.
Creación de la nueva lista: Se crea una nueva lista de reproducción en la base de datos con un nombre proporcionado por el usuario.
Actualización de las canciones: Las canciones de las listas originales se actualizan para que pertenezcan a la nueva lista. Esto significa que se cambia el identificador de la lista asociada en la base de datos.
Eliminación de las listas originales: Las listas originales que se combinaron se eliminan de la base de datos.
Recuperación de las canciones combinadas: Se recuperan las canciones de las dos listas originales y se guardan en la nueva lista combinada.
Actualización de la biblioteca del usuario: Finalmente, la nueva lista combinada se agrega a la biblioteca del usuario para que pueda acceder a ella junto con sus otras listas.
En resumen, esta función permite a los usuarios combinar dos listas de reproducción existentes en una nueva lista, manteniendo todas las canciones de ambas listas en una sola.




DIAGRAMA DE CLASES
 
 El diagrama de clases muestra cómo las clases Plataforma, Usuario, Lista y Canción se relacionan entre sí en nuestra aplicación de música.
 
Clase Plataforma:
Representa la plataforma de música.
Tiene una relación uno a muchos con la clase Usuario, lo que significa que una plataforma puede tener varios usuarios registrados.
Clase Usuario:
Representa a los usuarios que se registran en la plataforma.
Tiene una relación uno a muchos con la clase Lista, lo que significa que un usuario puede crear varias listas de reproducción.
Clase Lista:
Representa las listas de reproducción creadas por los usuarios.
Tiene una relación uno a muchos con la clase Canción, lo que significa que una lista de reproducción puede contener múltiples canciones.
Clase Canción:
Representa canciones individuales en la plataforma.
Tiene una relación uno a muchos con la clase Lista, ya que las canciones se crean en el 
