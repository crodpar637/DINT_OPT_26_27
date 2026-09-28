### **Resumen para configurar la sincronización de proyectos en GitHub desde VSCode**  

1. **Configurar Git en tu máquina:**
   - Asegúrate de que tu usuario y correo estén configurados correctamente:
     ```bash
     git config --global user.name "tu_nombre_de_usuario"
     git config --global user.email "tu_correo_de_github"
     ```
   - Si estás utilizando HTTPS, asegúrate de estar logueado con las credenciales correctas. Si es necesario, elimina las credenciales antiguas de tu gestor de credenciales y usa un [token de acceso personal (PAT)](https://github.com/settings/tokens) como contraseña.

---

2. **Configurar el repositorio:**
   - Inicializa el repositorio si aún no lo has hecho:
     ```bash
     git init
     ```
   - Agrega y configura un archivo `.gitignore` en la carpeta raíz del proyecto (`React`):
     ```plaintext
     node_modules/
     desktop.ini
     ```
   - Añade los archivos al índice y realiza el primer commit:
     ```bash
     git add .
     git commit -m "Initial commit"
     ```

---

3. **Conectar con GitHub:**
   - Crea un repositorio en GitHub y conéctalo con tu proyecto local:
     ```bash
     git remote add origin <URL_DEL_REPOSITORIO>
     git branch -M main
     git push -u origin main
     ```

---

5. **Sincronización automática en GitHub:**
   - Configura VSCode con la opción **Auto Save** para guardar los archivos automáticamente.
   - Usa tareas en VSCode o comandos manuales para realizar `git add`, `commit` y `push` según sea necesario:
     ```bash
     git add .
     git commit -m "Auto save changes"
     git push
     ```

---

Tus alumnos podrán clonar el repositorio y descargar los cambios con:
```bash
git clone <URL_DEL_REPOSITORIO>
git pull
``` 

Para crear una combinación de teclas que permita lanzar el proceso de sincronización automática con Git en VSCode, puedes configurar una **tarea personalizada** y asignarle un atajo de teclado. Aquí están los pasos detallados para sincronizar los cambios en GitHub.

---

### **1. Crear una tarea personalizada en VSCode**
1. **Abre el archivo de configuración de tareas:**
   - Ve a `Terminal > Configure Tasks > Create tasks.json file`.
   - Si ya tienes un archivo `tasks.json`, ábrelo para editarlo.

2. **Define una tarea para sincronizar cambios con Git:**
   - Agrega el siguiente contenido al archivo `tasks.json`:
     ```json
     {
       "version": "2.0.0",
       "tasks": [
         {
           "label": "Sync with GitHub",
           "type": "shell",
           "command": "git add . && git commit -m 'Auto save changes' && git push",
           "problemMatcher": [],
           "group": {
             "kind": "build",
             "isDefault": true
           }
         }
       ]
     }
     ```

   - **Descripción de los campos:**
     - `"label"`: El nombre de la tarea.
     - `"command"`: Los comandos Git que se ejecutarán.
     - `"isDefault"`: Define esta tarea como predeterminada para el grupo de tareas.

3. **Guarda el archivo.**

---

### **2. Asignar un atajo de teclado**
1. **Abre el archivo de configuración de atajos:**
   - Ve a `File > Preferences > Keyboard Shortcuts` (o usa `Ctrl+K Ctrl+S` en Windows/Linux, o `Cmd+K Cmd+S` en macOS).
   - Haz clic en el icono de ajustes (esquina superior derecha) y selecciona **"Open Keyboard Shortcuts (JSON)"**.

2. **Añade una entrada para la tarea personalizada:**
   - Agrega el siguiente fragmento al archivo de atajos:
     ```json
     {
       "key": "ctrl+alt+s", // Cambia esta combinación según prefieras
       "command": "workbench.action.tasks.runTask",
       "args": "Sync with GitHub"
     }
     ```

   - **Nota:** Cambia `"ctrl+alt+s"` por la combinación de teclas que desees (asegúrate de no usar una ya asignada).

3. **Guarda el archivo.**

---

### **3. Ejecutar la sincronización con la combinación de teclas**
- Una vez configurado, presiona la combinación de teclas (por ejemplo, `Ctrl+Alt+S`) para ejecutar la tarea de sincronización con Git.

---
