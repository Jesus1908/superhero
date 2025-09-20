# Superhero Reports System 🦸‍♂️

![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.x-orange)
![PHP](https://img.shields.io/badge/PHP-8.1-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.0-blue)

## Descripción del Proyecto

Sistema avanzado de generación de reportes sobre superhéroes desarrollado con CodeIgniter 4. Permite:

- 🔍 Búsqueda avanzada con autocompletado
- 📊 Generación de reportes en PDF
- 🏢 Filtrado por casas editoriales
- 📱 Diseño responsive

## Tabla de Contenidos

- [Características](#características-)
- [Tecnologías](#tecnologías-)
- [Instalación](#instalación-)
- [Estructura](#estructura-)
- [API](#api-)
- [Capturas](#capturas-)
- [Roadmap](#roadmap-)
- [Licencia](#licencia-)

## Características ✨

| Feature | Descripción |
|---------|-------------|
| Búsqueda en tiempo real | AJAX-powered search con sugerencias |
| Generación de PDFs | Reportes profesionales con HTML2PDF |
| Diseño responsive | Adaptable a móviles y tablets |
| Validación de datos | Seguridad en todas las entradas |

## Tecnologías 🛠️

- **Backend**: 
  - CodeIgniter 4
  - PHP 8.1
  - MySQL 8.0
- **Frontend**:
  - HTML5/CSS3
  - jQuery
  - Bootstrap (opcional)
- **PDF Generation**:
  - HTML2PDF
  - TCPDF

## Instalación ⚙️

```bash
# Clonar repositorio
git clone https://github.com/Jesus1908/superhero.git
cd superhero

# Instalar dependencias
composer install

# Configurar entorno (copiar .env.example a .env)
# Configurar credenciales de DB en .env

# Importar base de datos
mysql -u usuario -p superhero < database/schema.sql
```

## Estructura 📂

```
superhero/
├── app/
│   ├── Controllers/    # Lógica de aplicación
│   ├── Models/         # Modelos de datos
│   ├── Views/          # Vistas y plantillas
│   └── Config/         # Configuraciones
├── public/             # Assets públicos
└── tests/              # Pruebas unitarias
```

## API Endpoints 🌐

```rest
GET /api/buscar?nombre={query}   # Búsqueda de superhéroes
GET /reportes/generar-poderes/{id} # PDF de poderes
```

## Capturas 🖼️

*(Se requieren screenshots)*

## Roadmap 🗺️

- [x] Búsqueda básica
- [x] Generación de PDF
- [ ] Panel de administración
- [ ] Gráficos estadísticos

## Licencia 📜

MIT License - Ver [LICENSE](LICENSE) para detalles.