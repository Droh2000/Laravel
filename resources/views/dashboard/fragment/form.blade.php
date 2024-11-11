<!-- Vamos a Reutilizar los campos del formulario y adaptarlo a si es para Editar, Crea o Actualizar -->

<!--
            Al no tener nada y hacer click al boton obtendremos una pagina con codigo 419 esto es porque de manera interna Laravel
            implementa una proteccion a ataques CSRF (Es sobre falsificacion)
            Laravel genera un Token donde de manera interna sabe que este formulario que creamos es el correcto y no una copia de otro usuario

            Con esto ya no tenemos el erro del cliente de tipo 400
-->
@csrf()

    <!--
        Aqui tenemos que adaptar este formulario para adaptarlo al hacer la accion de CRear porque por los campos Values
        espera un objeto de tipo POST este se lo pasamos vacio y haci podemos convervar esta implementacion
        pero si toca agregar unas validaciones para ciertos campos
    -->

        <!-- Ponemos los campos que tenemos en la tabla 
            Por defecto si no cumplimos las validacion se nos borrara el contenido agregado por nosotros 
            para eso tenemos la funcion de ayuda old() para conservar los valores que tengan los campos del formulario
            los parametros son:
                Nombre del parametro que existe en la peticion y si existe coloca ese elemento
                Si no hay nada en el request entonces coloca el segundo parametro (Estos parametros los busca en el request o peticion)
                si exite el primero pone ese, sino entonces pone lo especificado en el segundo parametro

                    old('NombreCampoEnBD', ValorObtenidoDeLaPeticion)
        -->
        <label for="">Title</label>
        <input type="text" name="title" value="{{old('title', $post->title)}}"><!-- Le especificamos los mismos nombres que tenemos en la variable Fillable -->

        <label for="">Slug</label>
        <input type="text" name="slug" value="{{old('slug', $post->slug)}}">
        
        <label for="">Content</label>
        <textarea type="text" name="content">{{old('content', $post->content)}}</textarea>
        
        <label for="">Category_id</label>
        <select name="category_id">
            <!-- Manejos las cateogrias recibidas de la base de datos 
                En este caso por recibir en clave:valor obtenemos asi el Titulo -> id (Separando el valor de la clave) -->
            @foreach ($categories as $title => $id)
                <!--
                    Condicion agregado porque nos da error al leer la propiedad como NULL
                    comparando directamente con el campo de la base de datos cambiando la relacion porque no hace falta acceder a esta
                -->
                <option {{ old('category_id', $post->category_id) == $id ? "selected" : ''}} value={{$id}}>{{ $id }}</option>
            @endforeach
        </select>
        
        <label for="">Description</label>
        <textarea type="text" name="description">{{old('description', $post->description)}}</textarea>
        
        <label for="">Posted</label>
        <select name="posted">
            <!-- Aqui si le definimos las opciones ya que no las trae desde la BD-->
            <option {{old('posted', $post->posted) == 'yes' ? 'selected' : ''}} value="yes">Yes</option>
            <option {{old('posted', $post->posted) == 'no' ? 'selected' : ''}} value="no">No</option>
        </select>
        
        <!-- 
            CARGA DE IMAGENES
            
            La imagen estara en la carpeta "Public" que es la de acceso al del cliente que puede ser consumida
            No es obligatorio estar aqui porque si queremos usar archivos privados si estaran en otra ruta 

            En este caso como es una imagen que se requiere estar subida entonces la fase de creacion se puede complicar
            un poco porque podemos subir la imagen en su respectivo campo pero si los demas campos no pasan las
            validaciones se puede subir al servidor pero quedara huerfana ya que no se crea la publicacion hasta que no pase 
            las validaciones, el proceso puede ser complejor para procesar asi que una opcion rapida es mejor

            Es habilitar la opcion de carga de imagen cuando ya el registro del POST existe que es cuando le damos click en opcion de Editar
            (SE LE PASO UN PARAMETRO ADICIONAL QUE ES PARA SABER EL ESTADO si es de Editar entonces se activa para agregar la imagen)
            Con la funcion ISSET() le pasamos un objeto y verifica si esta definido en caso que no nos da FALSE (Si no los hacemos asi nos dara error toda la pagina
            porque el parametro solo se va a pasar al ser la opcion de Editar no en las demas opciones y no va a estar definido)

            Esta logica se implementa en el metodo UPDATE del controlador
        --> 
        @if (isset($task) && $task == 'edit')
            <label for="">Image</label>
            <input type="file" name="image"><!-- El name debe ser igual con la clase de validacion --> 
        @endif
        
        <button type="submit">Send</button>