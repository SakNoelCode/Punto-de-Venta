# 🤝 Guía para Contribuir

¡Gracias por tu interés en contribuir a este proyecto! Valoramos cada tipo de contribución, ya sea reportando errores, sugiriendo mejoras, corrigiendo documentación o desarrollando nuevas funcionalidades.

---

## Antes de empezar

1. **Buscar un problema o crear uno** - Verificar si el cambio que se desea implementar ya se ha discutido.
2. **Verificar las solicitudes de incorporación de cambios existentes** - Verificar que nadie esté trabajando en ello.
   
## Cómo empezar

1. Haz un **fork** de este repositorio (desde la rama develop).
2. Clona tu fork y ejecútalo localmente (consulta el archivo **README.md** para más detalles).
3. Crea una **nueva rama** para tus cambios:
 ```bash
   git checkout -b nombre-del-cambio
 ```
4. Realiza tus cambios siguiendo buenas prácticas de desarrollo.
5. Antes de realizar commit, asegúrate de que tu rama **develop** está actualizada con la del repositorio original
 ```bash
   git fetch upstream
   git checkout develop
   git merge upstream/develop
   git checkout nombre-del-cambio
   git rebase develop
 ```
6. Si aparecen conflictos al hacer ``` rebase ```, resuélvelos manualmente, luego continúa:
 ```bash
   git add archivo-resuelto
   git rebase --continue
 ```
8. Haz commit de tus cambios en tu rama con un mensaje claro:
```bash
   git commit -m "Descripción breve del cambio realizado"
```
8. Haz push a tu rama:
```bash
   git push origin fix/nombre-del-cambio
```
9. Abre un Pull Request en GitHub hacia la rama develop del repositorio original y describe tu contribución.

---
## 📝 Buenas prácticas
- Sigue la estructura y estilo del código del proyecto.
- Usa nombres descriptivos para ramas y commits.
- Asegúrate de que el proyecto sigue funcionando después de tus cambios.
- Si agregas nuevas funcionalidades, incluye pruebas si aplica.
- Documenta cualquier cambio relevante en el README.md u otros archivos.

## 🐞Reporte de errores
Si encuentras un error:
1. Verifica primero si ya ha sido reportado.
2. Si no, crea un issue nuevo e incluye la siguiente información:
   - Descripción clara del problema.
   - Pasos para reproducirlo.
   - Comportamiento esperado.
   - Capturas de pantalla o fragmentos de código si aplica.
   - Versión del proyecto utilizada.

## 💡Sugerencias de funcionalidades
¿Tienes una idea para mejorar el proyecto?
1. Abre un nuevo issue.
2. Incluye:
   - Descripción de la funcionalidad propuesta.
   - Problema que soluciona o mejora que aporta.
   - Posible implementación o ejemplos (opcional).

## 🛡️Código de Conducta
Por favor, asegúrate de seguir nuestro [Código de Conducta](https://github.com/SakNoelCode/Punto-de-Venta?tab=coc-ov-file "Código de Conducta") en todas tus interacciones con la comunidad.

## 📫Contacto
Si tienes dudas, sugerencias o necesitas ayuda, puedes abrir un issue o escribirnos a: **📧 [arcangelrs21@gmail.com]**
