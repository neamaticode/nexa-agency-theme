# NexaThemes Setup Guide

**Theme:** NexaAgency  
**Branding:** NexaThemes  
**Version:** 1.0.0  

---

## Overview

NexaAgency is a premium WordPress theme for digital agencies.  
After installing and activating the theme, use the **NexaThemes Setup** wizard to install required plugins and import demo content in one click.

---

## Required Plugins

| Plugin | Type | Purpose |
|--------|------|---------|
| **Elementor Website Builder** | Required | Visual drag-and-drop editor for all page sections |
| **One Click Demo Import** | Recommended | Imports demo pages, content, menus, and widgets in one click |
| **Contact Form 7** | Recommended | Powers the contact form section |

All plugins are free and available on the WordPress.org plugin repository.

---

## Running the Setup Wizard

1. **Install & activate** the NexaAgency theme.
2. A notice will appear at the top of the WordPress admin dashboard. Click **"Open NexaThemes Setup"**.
3. Alternatively, go to **Appearance → NexaThemes Setup** in the admin sidebar.

### Step 1 — Install Plugins

- The setup page lists all required and recommended plugins.
- Click **Install & Activate** next to each plugin, or install them manually from Plugins → Add New.
- When all plugins show a green **Active** badge, click **Continue to Import Demo →**.

### Step 2 — Import Demo Content

- Click **Import Demo Content (One Click)** to open the One Click Demo Import screen.
- Click **Import** on the "NexaThemes — Full Demo" preset.
- The following content will be imported:
  - Pages: Home, About, Contact, Portfolio, Blog
  - Sample Services, Portfolio items, Team members, Testimonials
  - Primary and Footer navigation menus
  - Widget settings (sidebar)
  - Customizer settings (brand colors, contact info, social links)
  - Elementor homepage template *(if available — see below)*

### Step 3 — Finish

- Verify that the homepage, menus, and permalinks are correctly configured.
- Use the quick links to open **Appearance → Customize** and edit brand colors, logo, contact info, and social links.
- Open any page in **Elementor** to customize it visually.

---

## Providing the Elementor Homepage Template

> **Important:** The `demo-data/elementor/home-template.json` file shipped with the theme is a **placeholder**. The demo import will work without it, but the Elementor visual design for the Home page will not be applied automatically.

### How to Create and Supply the Template

1. Build (or design) the homepage in Elementor:
   - Go to **Pages → Home → Edit with Elementor**.
   - Design all sections (Hero, About, Services, Portfolio, Team, Testimonials, Stats, Contact).

2. Export the template:
   - Inside Elementor, click the **hamburger menu** (☰, top-left).
   - Go to **Save as Template** → name it "NexaThemes Home".
   - Then go to **Elementor → My Templates**.
   - Find your template and click **Export**.
   - A `.json` file will be downloaded.

3. Replace the placeholder:
   - Copy the downloaded JSON file into the theme's `demo-data/elementor/` folder.
   - Rename it to `home-template.json` (replacing the existing placeholder).

4. The next time a customer runs **Import Demo**, the Elementor design will be automatically applied to the Home page.

---

## Updating Demo Images and Content

### Demo XML Content (`demo-data/demo-content.xml`)

The WXR file contains sample pages, services, team members, and testimonials.  
To update it:

1. Build your site with the desired demo content.
2. Go to **Tools → Export → All Content** and download the export file.
3. Replace `demo-data/demo-content.xml` with the downloaded file.

### Customizer Settings (`demo-data/customizer.dat`)

This file is a PHP-serialized array of `theme_mods`.  
To update it, use the [Customizer Export/Import plugin](https://wordpress.org/plugins/customizer-export-import/):

1. Install and activate the plugin.
2. In **Appearance → Customize → Export/Import**, click **Export** to download a `.dat` file.
3. Replace `demo-data/customizer.dat` with your exported file.

### Widget Settings (`demo-data/widgets.wie`)

This file is a JSON export of sidebar widgets.  
To update it, use the [Widget Importer & Exporter plugin](https://wordpress.org/plugins/widget-importer-exporter/):

1. Install and activate the plugin.
2. In **Tools → Widget Importer & Exporter**, click **Export Widgets** to download a `.wie` file.
3. Replace `demo-data/widgets.wie` with your exported file.

---

## Theme Architecture

```
nexa-agency-theme/
├── functions.php               Main functions file; loads all modules
├── inc/
│   ├── admin/
│   │   ├── admin-notices.php   Branded admin notices after activation
│   │   ├── setup-page.php      NexaThemes Setup wizard (3 steps)
│   │   └── demo-import.php     OCDI integration hooks
│   ├── tgmpa/
│   │   └── class-tgm-plugin-activation.php  Plugin activation helper
│   ├── custom-post-types.php   Services, Portfolio, Team, Testimonials CPTs
│   ├── customizer.php          Theme Customizer settings
│   ├── enqueue.php             Script and style enqueue
│   ├── helpers.php             Helper functions
│   ├── widgets.php             Widget areas
│   └── ajax-handlers.php       AJAX contact form
├── demo-data/
│   ├── demo-content.xml        WordPress WXR export (pages + CPT content)
│   ├── widgets.wie             Widget export (JSON)
│   ├── customizer.dat          Customizer export (PHP serialized)
│   └── elementor/
│       └── home-template.json  Elementor template (replace placeholder with real export)
├── page-templates/
│   ├── page-home.php           Home page template (PHP fallback)
│   ├── page-portfolio.php      Portfolio page template
│   └── page-contact.php        Contact page template
├── template-parts/home/        Modular PHP home sections (fallback)
└── docs/
    └── setup.md                This file
```

---

## Fallback Behavior (Without Elementor)

The theme is designed to work without Elementor:

- If Elementor is **not installed**, the Home page renders using `page-templates/page-home.php` with the PHP template sections (`template-parts/home/`).
- Content for sections (services, portfolio, team, etc.) is still drawn from Custom Post Types and Customizer settings.
- If Elementor **is installed** and the imported Home page has Elementor data, Elementor takes over the rendering.
- The theme will **never white-screen** due to a missing Elementor or missing template JSON.

---

## Troubleshooting

| Problem | Solution |
|---------|----------|
| "Elementor template not found" warning | Replace `demo-data/elementor/home-template.json` with your real Elementor export |
| Homepage shows blog posts instead of Home page | Go to Settings → Reading → set "Your homepage displays" to the Home page |
| Menu not showing | Go to Appearance → Menus → assign a menu to "Primary Navigation" |
| Pretty permalinks not working | Go to Settings → Permalinks → choose "Post name" and save |
| Demo import fails | Ensure One Click Demo Import plugin is active, then retry |

---

## Support

For theme support, please visit:  
[https://github.com/neamaticode/nexa-agency-theme](https://github.com/neamaticode/nexa-agency-theme)
