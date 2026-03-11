# NexaAgency — Premium WordPress Theme

A production-ready WordPress theme for digital agencies and startups. Features a full one-page layout with portfolio, services, team, testimonials, pricing, and an AJAX contact form.

---

## Features

- **One-Page Layout** — Hero, Services, About, Stats, Portfolio, Team, Testimonials, Pricing, Blog, Contact sections
- **Dark Modern Design** — CSS custom properties, gradient text, glassmorphism header
- **Custom Post Types** — Portfolio, Team, Testimonials, Services
- **WordPress Customizer** — Live-preview color controls + all section content editable
- **AJAX Contact Form** — Nonce-secured, fully validated, `wp_mail()` delivery
- **AOS Animations** — Scroll-triggered fade/slide animations via `aos@2.3.4`
- **Block Editor Ready** — `theme.json` palette, `align-wide`, editor styles
- **Translation Ready** — Full `load_theme_textdomain()` support, all strings wrapped
- **Accessibility** — Semantic HTML5, ARIA labels, keyboard navigation
- **Performance** — Deferred scripts, CDN for fonts/AOS, minimal dependencies
- **RTL Support** — Full RTL CSS rules in `responsive.css`
- **Responsive** — Desktop-first, breakpoints at 1400/1200/992/768/576/480px

---

## Requirements

| Requirement | Minimum |
|---|---|
| WordPress | 6.0+ |
| PHP | 7.4+ |
| Tested up to | WordPress 6.7 |

---

## Installation

1. Upload the `nexa-agency-theme` folder to `/wp-content/themes/`
2. Activate via **Appearance → Themes**
3. Create a page, assign **Template: Home Page**
4. Set it as the static front page under **Settings → Reading**
5. Configure via **Appearance → Customize → Theme Options**

---

## File Structure

```
nexa-agency-theme/
├── style.css                        # Theme header + CSS imports
├── functions.php                    # Theme bootstrap, constants, requires
├── index.php                        # Blog index
├── header.php                       # Sticky header, nav, hamburger
├── footer.php                       # Footer columns, widgets, copyright
├── page.php                         # Default page template
├── single.php                       # Single post with author box + nav
├── archive.php                      # Archive / category loop
├── search.php                       # Search results
├── 404.php                          # 404 error page
├── comments.php                     # Comments list + form
├── sidebar.php                      # Main sidebar
├── theme.json                       # Block editor palette + typography
│
├── assets/
│   ├── css/
│   │   ├── main.css                 # Core styles, components, layout
│   │   ├── animations.css           # Keyframes + animation classes
│   │   └── responsive.css          # Breakpoints + RTL rules
│   ├── js/
│   │   ├── main.js                  # Scroll, nav, counter, filter logic
│   │   ├── contact.js               # AJAX form validation + submission
│   │   └── animations.js            # AOS init, parallax, carousel
│   └── images/
│       └── .gitkeep
│
├── template-parts/
│   ├── content.php                  # Blog post card
│   ├── content-single.php           # Single post content
│   ├── content-none.php             # No results message
│   └── home/
│       ├── hero.php                 # Hero section
│       ├── services.php             # Services grid (6 cards)
│       ├── about.php                # About split layout
│       ├── stats.php                # Animated counters (4)
│       ├── portfolio.php            # Filter + portfolio grid
│       ├── team.php                 # Team cards (4)
│       ├── testimonials.php         # Testimonial cards (3)
│       ├── pricing.php              # Pricing tiers (3)
│       ├── blog-preview.php         # Latest 3 posts
│       └── contact.php              # AJAX contact form
│
├── page-templates/
│   ├── page-home.php                # Home Page template
│   ├── page-portfolio.php           # Full Portfolio template
│   └── page-contact.php             # Contact Page template
│
└── inc/
    ├── enqueue.php                  # Scripts + styles enqueueing
    ├── custom-post-types.php        # CPT + meta boxes registration
    ├── customizer.php               # Customizer panel/sections/controls
    ├── widgets.php                  # Sidebar + footer widget areas
    ├── helpers.php                  # Utility functions
    └── ajax-handlers.php            # Contact form AJAX handler
```

---

## Custom Post Types

| Post Type | Slug | Purpose |
|---|---|---|
| Services | `nexa_service` | Agency services |
| Portfolio | `nexa_portfolio` | Case studies & projects |
| Team Members | `nexa_team` | Staff profiles |
| Testimonials | `nexa_testimonial` | Client reviews |

**Portfolio** also registers the `nexa_portfolio_category` taxonomy.

---

## Customizer Options

Navigate to **Appearance → Customize → Theme Options**:

| Section | Settings |
|---|---|
| Colors | Primary, Secondary, Accent colors (live preview) |
| Hero | Badge, Title, Subtitle, 2x CTA buttons |
| About | Eyebrow, Title, Description, Image, Button |
| Stats | 4 stat numbers + labels |
| Contact Info | Email, Phone, Address |
| Social Media | Facebook, Twitter, Instagram, LinkedIn, YouTube |
| Footer | Tagline, Copyright text |

---

## AJAX Contact Form

The contact form posts to `admin-ajax.php` with action `nexa_contact_form`.

**Validation (JS + PHP):**
- Name — required
- Email — required + format check
- Message — required, min 10 characters

**Security:**
- WordPress nonce (`nexa_contact_nonce`) verified on both client and server
- All inputs sanitized with `sanitize_text_field`, `sanitize_email`, `sanitize_textarea_field`
- Output sent via `wp_mail()` with `Reply-To` header

---

## Color Variables

```css
--primary:   #6C63FF   /* Purple  */
--secondary: #FF6584   /* Pink    */
--accent:    #3ecfcf   /* Teal    */
--dark:      #0F0E17   /* Near-black background */
--light:     #FFFFFE   /* Off-white text */
--gray:      #A7A9BE   /* Muted text */
```

---

## Menus

| Location | Description |
|---|---|
| `primary` | Main header navigation |
| `footer` | Footer navigation |
| `social` | Social icon links |

---

## Image Sizes

| Name | Dimensions | Crop |
|---|---|---|
| `nexa-hero` | 1920x1080 | Yes |
| `nexa-card` | 600x400 | Yes |
| `nexa-portrait` | 400x500 | Yes |

---

## License

GNU General Public License v2 or later — https://www.gnu.org/licenses/gpl-2.0.html

---

## Credits

- [Inter Font](https://fonts.google.com/specimen/Inter) — Google Fonts (OFL 1.1)
- [AOS](https://michalsnik.github.io/aos/) — Animate On Scroll library (MIT)
