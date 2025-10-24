# 🖥️ Práctica Final : Git + GitHub + VS Code + Formulario Web

## 1️⃣ Gestionar un proyecto con Git y GitHub desde VS Code

 ### ¿Qué debemos tener en cuenta cuando queramos iniciar un proyecto con GitHub?
  Principalmente, cuando empiezas un proyecto con Git y GitHub es esencial que uno de los miembros cree una organización y, dentro de él, un repositorio en Github y enlace su repositorio local con el remoto. A continuación, el compañero creará un clon `git clone + url repositorio` del repositorio en cuestión para poder trabajar sobre el mismo proyecto. 
   Más adelante, existen 2 formas de crear commits e ir subiendo nuestros avances desde VS Code:
   **Mediante terminal**
   **Con el panel de control de VS Code**
    Nosotros hemos escogido desde el terminal para evitar conflictos y saber siempre que comando metemos para no forzar ningún cambio y tener control de las subidas y bajadas de nuestro repositorio.
    



## 2️⃣ Asignar roles y justificarlos al READ-ME o en un documento espedífico


## 3️⃣ Elaborar y exportar un cronograma Gantt básico con dependencias

## 4️⃣ Vincular commits e issues/tarjetas del tauler(GitHub Projects/Trello) para la trazabilidad
 Dentro de GitHub, entramos al repositorio y dentro del proyecto tenemos el apartado *Board*. Esta herramienta nos permite añadir tareas, indicar las categorías(aunque normalmente tienes que crearlas), añadir columnas de trazabilidad(estado de la tarea), añadir issues(problemas) que hayan surgido para acordarnos y comentar como solucionarlos con el grupo y añadir iteraciones(sprints) para repartir el proyecto en lineas temporales para establecer fechas límites a nuestras tareas. 
  Esta herramienta simula la aplicación Trello pero tiene más funcionalidades, asique es la que utilizaremos.
   Por otro lado, cuando nos pongamos a trabajar en nuestro proyecto debemos realizar commits para identificar las tareas realizadas y el estado de nuestro proyecto. Para ello, añadiremos la información realizada `git add .`, realizaremos un `git commit -m "Tarea realizada"` para después hacer un `git push` de nuestro repositorio local al remoto y así ver como lo llevamos en gitHub. Más adelante explicaremos como organizar las tareas al trabajar en grupo. 

## 5️⃣ Crear un formulario sencillo con HTML5 +JavaScript
 Para empezar a trabajar todos los aspectos dados en el curso debemos tener una plantilla donde realizar cambios como prueba de una página Web como enlazarla a un servidor de datos*(PHP)*, añadirle interactividad*(JavaScript)*, darle un diseño de estilos *(DIW)* y probar a crear una clave propia y ciberseguridad estableciéndolo en un puerto 443 con un cifrado personalizado*(DAW)*.
  Para ello necesitamos una versión de prueba que, aunque no sea la página principal, se puedan realizar todas estas adiciones para empezar a trabajar como es debido.

## 6️⃣

## 7️⃣ Trabajar con ramas y practicar el merge
 En nuestro caso, hemos tenido bastantes problemas a la hora de aprender a trabajar varias personas dentro del mismo proyecto. Por ello, hemos aprendido paso a paso como realizar el merge para no tener futuros problemas. En primer lugar, ambos miembros del grupo han de crearse una rama para trabajar independientemente `git branch *tu rama*`. Una vez creadas, se ejecutan los comandos que hemos visto en  *Vincular commits e issues/tarjetas del tauler(GitHub Projects/Trello) para la trazabilidad*, una vez que queramos subir estos cambios a la rama main, primero debemos ir a la rama main con `git checkout main` para hacer un `git pull` que se baje cualquier cambio que haya hecho tu compañero y una vez que main esté actualizada vuelves a tu rama `git checkout tu rama` y ejecutar un `git merge`. Es por esto que, aun siguiendo los pasos se haga un *Non-fastforward* y te toca ir viendo los cambios uno a uno e ir añadiendo y suprimiendo. Por esta misma razón, trabajaremos en ámbitos separados fuera del proyecto y una vez que queramos subir algo, hablarlo con mi compañera y hacer los cambios en el orden correcto.
## 8️⃣