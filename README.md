# Flamebubbles Atelier

A custom WordPress WooCommerce theme built for editorial product storytelling, premium fashion storefronts, and responsive shopping flows.

## Highlights

- Custom-coded WooCommerce archive and single product templates
- Editorial homepage sections for collections, latest products, testimonials, and gallery
- Responsive desktop, tablet, and mobile layouts
- Minimal JavaScript with WooCommerce-native purchase flows
- Theme Customizer support for key storefront content

## Requirements

- WordPress 6.4+
- WooCommerce
- PHP 7.4+

## Theme Structure

```text
assets/
  css/
  js/
inc/
template-parts/
woocommerce/
functions.php
front-page.php
style.css
theme.json
```

## Installation

1. Copy the `flamebubbles-atelier` folder into `wp-content/themes/`
2. Activate the theme from WordPress Admin
3. Install and activate WooCommerce
4. Assign your menus, widgets, and WooCommerce pages

## WooCommerce Notes

- The theme includes custom templates for shop archive and single product pages.
- Product categories, images, attributes, and short descriptions drive much of the storefront presentation.
- For the best single product layout, use high-quality featured images and complete WooCommerce product data.

## Development

- Main theme bootstrap: `functions.php`
- Theme setup and supports: `inc/setup.php`
- WooCommerce behavior: `inc/woocommerce-setup.php`
- Styles: `assets/css/`
- Scripts: `assets/js/`

## GitHub Auto Deploy

This theme includes a GitHub Actions workflow at `.github/workflows/deploy-live.yml`.

When you push to the `main` branch, GitHub Actions can deploy the theme directly to your live WordPress server.

### Recommended deploy method

- `sftp` is recommended
- `ftp` or `ftps` can also be used if your hosting requires it

### Required GitHub repository secrets

Add these in:
`GitHub Repo -> Settings -> Secrets and variables -> Actions`

- `DEPLOY_HOST`
- `DEPLOY_USERNAME`
- `DEPLOY_PASSWORD`
- `DEPLOY_REMOTE_PATH`

Optional secrets:

- `DEPLOY_PORT`
- `DEPLOY_PROTOCOL`

### Example values

For many WordPress hosts:

- `DEPLOY_PROTOCOL`: `sftp`
- `DEPLOY_PORT`: `22`
- `DEPLOY_REMOTE_PATH`: `/home/your-user/domains/your-domain.com/public_html/wp-content/themes/flamebubbles-atelier`

If you use Hostinger, the remote path is often similar to:

- `/home/u123456789/domains/your-domain.com/public_html/wp-content/themes/flamebubbles-atelier`

### How deploy works

- On every push to `main`, GitHub Actions checks PHP syntax
- It connects to your server using `lftp`
- It uploads the theme files from the repository root to your live theme directory
- It does not upload `.git`, `.github`, `.gitignore`, or `README.md`

### Suggested workflow

1. Push this theme repo to GitHub
2. Add the deployment secrets
3. Push future changes to `main`
4. GitHub Actions will deploy the updated theme automatically

### Important note

The workflow currently uploads changed files but does not force-delete removed files on the live server. This is safer for live deployment.

## Version

Current theme version: `1.0.0`
