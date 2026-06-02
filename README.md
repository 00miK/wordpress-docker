# WordPress Docker

Environnement de développement WordPress local avec Docker, incluant un thème PHP personnalisé, une intégration de l'API NewsAPI et une capture d'emails via MailHog.

## Prérequis

- [Docker](https://www.docker.com/) et Docker Compose

## Démarrage rapide

```bash
docker compose up -d
```

Après le démarrage, injecter la clé API NewsAPI (fournie séparément) :

```bash
docker exec wordpress-docker-wordpress-1 bash -c "sed -i \"/require_once/i define('NEWSAPI_KEY', 'VOTRE_CLE_ICI');\" /var/www/html/wp-config.php"
```

- WordPress : http://localhost:8000
- Admin : http://localhost:8000/wp-admin (identifiant : admin)
- MailHog (capture emails) : http://localhost:8025

> **Note :** La clé API doit être réinjectée après chaque `docker compose down` / `up`.

## Structure du projet

```
wordpress-docker/
├── docker-compose.yml
└── wp-data/                        # Monté sur /var/www/html/wp-content
    ├── themes/
    │   ├── mon-theme/              # Thème actif
    │   ├── twentytwentythree/
    │   └── twentytwentyfour/
    └── plugins/
        └── akismet/
```

## Services Docker

| Service     | Image            | Port exposé |
| ----------- | ---------------- | ----------- |
| `wordpress` | wordpress:latest | 8000        |
| `db`        | mysql:8.0        | —           |
| `mailhog`   | mailhog/mailhog  | 8025        |

La base de données est persistée dans le volume Docker `db_data`.

## Thème : mon-theme

Thème PHP classique (non FSE) développé par Michael Tarei.

**Couleur principale :** `#0f7ab5`

### Fichiers du thème

| Fichier                 | Rôle                                                    |
| ----------------------- | ------------------------------------------------------- |
| `style.css`             | Styles globaux (reset, layout, composants, responsive)  |
| `functions.php`         | Enqueue CSS/JS, menu principal, thumbnails, config SMTP |
| `header.php`            | `<head>`, header et navigation                          |
| `footer.php`            | Footer et `wp_footer()`                                 |
| `index.php`             | Page d'accueil (hero, à propos, derniers articles)      |
| `home.php`              | Listing blog (cards + pagination)                       |
| `single.php`            | Article individuel                                      |
| `page-contact.php`      | Page contact (affiche `the_content()`)                  |
| `page-nos-services.php` | Page services (3 cartes statiques)                      |
| `page-actualites.php`   | Page actualités (intégration API NewsAPI)               |
| `spa.js`                | Navigation SPA client-side                              |

### Navigation SPA

`spa.js` intercepte les clics sur les liens internes et charge les pages via `fetch()` + `history.pushState`, en ne remplaçant que le contenu de `<main>` sans rechargement complet. Les liens vers `wp-admin`, `wp-login`, les ancres et les domaines externes sont exclus.

### Intégration API NewsAPI

La page Actualités récupère dynamiquement les dernières actualités de Belgique via l'API NewsAPI (endpoint `/v2/everything`). Fonctionnalités :

- Appel PHP côté serveur via `wp_remote_get()`
- Filtre par catégorie (Business, Technology, Sports, Health, Entertainment)
- Dédoublonnage des articles par similarité de titre
- Gestion d'erreur si l'API ne répond pas
- Clé API protégée dans `wp-config.php` (non présente sur GitHub)

### Emails en développement

Les emails envoyés par WordPress (formulaires, notifications) sont interceptés par MailHog et consultables sur http://localhost:8025. La configuration SMTP est définie dans `functions.php` (hôte `mailhog`, port `1025`).

## Commandes utiles

```bash
# Démarrer les containers
docker compose up -d

# Arrêter les containers
docker compose down

# Voir les logs WordPress
docker compose logs wordpress

# Supprimer les containers et la base de données
docker compose down -v
```
