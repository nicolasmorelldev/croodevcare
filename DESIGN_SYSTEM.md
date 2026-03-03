# Croodev Care Design System

## 1. Brand Decision

### Recommended naming
**Croodev Care**

### Why this is the best option
- `Care` is the most elegant and internationally legible option in the proposed list.
- It feels human and premium without sounding like a disaster-only platform.
- It supports both single-cause campaigns and a broader long-term product vision.
- Visually, `Croodev` keeps the main brand weight while `Care` works naturally as a refined sub-brand.

### Naming lockup
- Primary lockup: `Croodev` + official logo + `Care`
- Visual rule: `Croodev` remains the dominant brand wordmark.
- `Care` should appear lighter, more editorial, and slightly more spaced.
- Footer lockup: `Concept by` + Croodev logo

### Logo handling
- Source logo provided by client: `/home/magento/Downloads/logocroodev-1 (1).svg`
- Current logo is monochrome black, which works well with the selected system.
- Repo target path for implementation: `public/branding/croodev-logo.svg`
- Do not distort the logo. Preserve original proportions and use it as-is.

## 2. Initial Visual Directions

### Direction A: Quiet Assurance
**Concept**
A calm, premium, trustworthy system with editorial spacing, warm neutrals, dark ink typography, and restrained green accents. The emotional tone comes from photography, whitespace, and copy, not from saturated charity-style color.

**Visual traits**
- Warm ivory backgrounds
- Ink / graphite typography
- Forest green as trust accent
- Muted sage and clay for supporting surfaces
- Large blocks, soft shadows, generous rhythm
- Premium editorial typography mix

**Why it works**
- Feels serious enough for money and trust
- Feels humane without looking handmade or improvised
- Supports both emotional storytelling and structured transactional UI
- Translates cleanly to an admin interface

### Direction B: Modern Civic Signal
**Concept**
A sharper, more product-led system with cool stone neutrals, precise spacing, deep navy, and a restrained mineral blue. More startup-like, slightly less warm.

**Visual traits**
- Stone and mist backgrounds
- Navy-dominant interface
- Mineral blue interactive accents
- More geometric cards and tighter layouts
- Stronger SaaS feel

**Why it works**
- Feels modern and scalable
- Very legible for dashboards and admin flows
- Less emotionally distinctive for the public donation narrative

## 3. Chosen Direction

### Selected direction
**Direction A: Quiet Assurance**

### Selection rationale
- This product must convert through trust and clarity, not through urgency theater.
- A warmer editorial system gives the public site stronger emotional credibility.
- The black Croodev logo sits naturally inside an ivory/ink/forest palette.
- The same direction can be adapted into a polished admin without creating two disconnected products.

## 4. Brand Personality

### Tone
- Clear
- Respectful
- Human
- Precise
- Calm
- Trust-first

### Avoid
- NGO-template language
- exaggerated sentimentality
- corporate coldness
- sales-heavy urgency
- dramatic red alerts unless the data is actually critical

## 5. Design Tokens

### Color system

#### Core
- `--color-ink: #171717`
- `--color-graphite: #2B2F2D`
- `--color-ivory: #F6F1E8`
- `--color-paper: #FFFDFC`
- `--color-forest: #285446`
- `--color-sage: #DDE6DE`
- `--color-clay: #C9825B`
- `--color-gold-mist: #E9D8B4`

#### Interface neutrals
- `--color-line: #DDD6CA`
- `--color-panel: #F3EEE6`
- `--color-panel-strong: #ECE4D8`
- `--color-muted: #6D6A64`

#### Semantic
- `--color-success: #2F6A51`
- `--color-warning: #B9853B`
- `--color-danger: #A94A3B`
- `--color-info: #4D6B7A`

#### Accessibility rule
- Body text should default to `ink` on `paper` or `ivory`.
- Forest is for trust/action, not for large dense text blocks.
- Clay is an accent, not the primary CTA color.

### Typography

#### Primary display / editorial
- `Cormorant Garamond` or `Fraunces`
- Use for hero heading fragments, section intros, highlighted numbers, or premium emphasis.

#### Primary UI / body
- `Manrope`
- Use for body copy, buttons, labels, navigation, cards, admin UI.

#### Fallback stacks
- Display fallback: `Georgia, serif`
- UI fallback: `system-ui, sans-serif`

### Type scale
- `display-xl`: 64/68 desktop, 44/48 mobile
- `display-lg`: 52/58 desktop, 36/42 mobile
- `heading-xl`: 40/46 desktop, 30/36 mobile
- `heading-lg`: 32/38 desktop, 24/30 mobile
- `heading-md`: 24/30
- `body-lg`: 18/30
- `body-md`: 16/28
- `body-sm`: 14/22
- `label`: 12/16 uppercase with subtle letter spacing

### Spacing scale
- `4, 8, 12, 16, 24, 32, 48, 72, 96, 128`

### Radius
- `--radius-sm: 12px`
- `--radius-md: 20px`
- `--radius-lg: 32px`
- `--radius-pill: 999px`

### Shadow system
- `--shadow-soft: 0 12px 30px rgba(23, 23, 23, 0.06)`
- `--shadow-card: 0 18px 45px rgba(23, 23, 23, 0.08)`
- `--shadow-float: 0 30px 70px rgba(23, 23, 23, 0.12)`

## 6. Surface Language

### Public site
- Large airy sections with strong vertical rhythm
- Layered surfaces: `paper` base, `panel` cards, occasional forest panels
- Photos should feel documentary and respectful, never stock-charity cliché
- Progress and needs modules should look product-grade, not campaign-widget grade

### Admin
- Same tokens, more restrained application
- Use `paper` or white base with `panel` surfaces
- Keep admin highly readable with slightly denser spacing
- Forest should anchor primary actions and active states

## 7. Layout Principles

### Grid
- Public container: `max-w-[1240px]`
- Reading container: `max-w-[760px]`
- Admin container: `max-w-[1400px]`
- Standard section padding desktop: `py-24`
- Standard section padding mobile: `py-16`

### Rhythm
- Each section needs a strong intro, a primary content block, and a clear next action.
- No crowded cards.
- No walls of text longer than 3 short paragraphs without a visual interruption.

## 8. Public Experience Structure

### Header
- Sticky, translucent ivory background with subtle blur and bottom border
- Left: Croodev logo + `Care`
- Center/right: navigation
- Primary CTA: `Help now`
- Mobile: slide-down panel or clean drawer, not a cluttered mega-menu

### Hero
- Two-column desktop, stacked mobile
- Left: eyebrow, headline, story summary, progress snapshot, CTA cluster
- Right: main photo with soft radius and overlaid trust card
- Trust card can include:
  - goal amount
  - raised amount
  - percentage funded
  - last update date

### Story / context
- Editorial block with narrow reading width
- Supporting photos in asymmetrical layout
- Use pull-quote or highlight fact panel

### How to help
- 3 or 4 cards max in first viewport of the section
- Cards:
  - contribute funds
  - share the cause
  - partner or sponsor
  - direct assistance

### Suggested amounts
- One premium conversion module
- Amount chips should feel like product controls, not plain buttons
- Include short impact caption under each preset
- `Other amount` should be visually equal, not secondary or hidden

### Needs
- Structured list or card grid with statuses
- Statuses:
  - urgent
  - partially covered
  - completed
- Show amount and context when relevant

### Updates / timeline
- Vertical timeline with date anchors
- Each update can include title, short note, optional image
- Use clean chronology, not social-feed styling

### Transparency
- Must feel institutional but not bureaucratic
- Include:
  - who manages funds
  - available payment methods
  - reporting promise
  - legal note
  - contact

### Footer
- Quiet but substantial
- 3 or 4 columns on desktop
- Include `Concept by` + Croodev logo line with restrained emphasis

## 9. Admin Experience Structure

### Overall pattern
- Sidebar + topbar + content canvas
- Sidebar should feel product-grade, not template-admin
- Use the same fonts and neutrals as public UI

### Sidebar sections
- Dashboard
- Causes
- Updates
- Needs
- Suggested amounts
- Donation methods
- Gallery
- FAQs
- Settings
- Admin users

### Dashboard widgets
- Funds raised
- Demo contributions
- Active causes
- Progress by cause
- Recent activity

### Data views
- Cards for metrics
- Clean tables with generous row height
- Status pills using semantic colors
- Empty states with concise guidance

### Forms
- Two-column on desktop when appropriate
- Sticky action bar for long edit forms
- Image upload blocks should include preview and caption guidance

## 10. Core Reusable Components

### Blade component map
- `resources/views/components/brand/logo.blade.php`
- `resources/views/components/brand/lockup.blade.php`
- `resources/views/components/layout/public-header.blade.php`
- `resources/views/components/layout/public-footer.blade.php`
- `resources/views/components/layout/admin-sidebar.blade.php`
- `resources/views/components/layout/admin-topbar.blade.php`
- `resources/views/components/ui/button.blade.php`
- `resources/views/components/ui/badge.blade.php`
- `resources/views/components/ui/card.blade.php`
- `resources/views/components/ui/stat.blade.php`
- `resources/views/components/ui/section-heading.blade.php`
- `resources/views/components/ui/progress-bar.blade.php`
- `resources/views/components/ui/amount-chip.blade.php`
- `resources/views/components/ui/status-pill.blade.php`
- `resources/views/components/ui/empty-state.blade.php`
- `resources/views/components/ui/input.blade.php`
- `resources/views/components/ui/textarea.blade.php`
- `resources/views/components/ui/select.blade.php`
- `resources/views/components/ui/table.blade.php`
- `resources/views/components/ui/panel.blade.php`
- `resources/views/components/cause/hero.blade.php`
- `resources/views/components/cause/story-block.blade.php`
- `resources/views/components/cause/help-options.blade.php`
- `resources/views/components/cause/needs-grid.blade.php`
- `resources/views/components/cause/update-timeline.blade.php`
- `resources/views/components/cause/gallery-grid.blade.php`
- `resources/views/components/cause/transparency-panel.blade.php`

### CSS structure proposal
- `resources/css/app.css`
- `resources/css/base/tokens.css`
- `resources/css/base/typography.css`
- `resources/css/base/utilities.css`
- `resources/css/components/buttons.css`
- `resources/css/components/cards.css`
- `resources/css/components/forms.css`
- `resources/css/components/timeline.css`
- `resources/css/components/admin.css`

### Tailwind usage rule
- Use Tailwind for layout and spacing speed.
- Store identity decisions in CSS variables and a small layer of semantic utility classes.
- Do not let pages become long strings of arbitrary values without shared patterns.

## 11. Component Behavior Specs

### Button variants
- `primary`: forest background, paper text
- `secondary`: ink text, ivory/panel background, subtle border
- `ghost`: transparent with ink text
- `danger-soft`: pale danger surface for admin destructive confirmations

### Badge variants
- `eyebrow`
- `status-urgent`
- `status-partial`
- `status-complete`
- `status-draft`

### Card variants
- `story`
- `metric`
- `action`
- `need`
- `admin-table-shell`

### Form fields
- Large radius
- Strong focus ring in forest
- Labels always visible
- Helper text in muted tone
- Errors in danger with compact explanation

## 12. Photography Direction

### Use
- Real, respectful, high-resolution imagery
- Natural light
- Documentary framing
- Human presence with dignity

### Avoid
- overly staged gratitude shots
- generic volunteer stock photography
- loud overlays over faces
- heavy darkening filters

## 13. Motion Direction

### Motion style
- Calm and purposeful
- Short fades and upward reveals
- Subtle progress fill animation
- Soft hover elevation on action cards

### Avoid
- bouncing UI
- exaggerated scale effects
- constant animated gradients

## 14. Microcopy Base

### Primary CTAs
- `Help now`
- `Contribute today`
- `Support this cause`
- `See the full story`

### Supporting copy examples
- `Every contribution moves this case forward with clarity and accountability.`
- `Choose a suggested amount or enter your own contribution.`
- `This campaign is managed with transparent updates and documented progress.`

### Need labels
- `Urgent this week`
- `Partially covered`
- `Already funded`

### Empty state tone
- `No updates published yet. New progress notes will appear here.`
- `No gallery items yet. Images and evidence will be added as the case evolves.`
- `No suggested amounts configured yet.`

### Admin helper tone
- `Shown on the public campaign header. Keep it clear and specific.`
- `Use short factual updates. Avoid repetition and emotional overstatement.`
- `Mark as urgent only when it requires immediate public visibility.`

## 15. Public Page Content Blueprint

### Home
- Hero
- Story snapshot
- Help options
- Suggested amounts
- Need items
- Updates timeline
- Gallery
- Transparency
- FAQ

### Cause detail
- Deeper hero
- Full narrative
- Expanded update history
- Donation widget
- Gallery
- FAQ

## 16. Admin Screen Blueprint

### Dashboard
- KPI row
- Cause progress cards
- Recent updates
- Quick actions

### Cause editor
- Hero fields
- Story fields
- Progress fields
- Transparency fields
- SEO fields

### Suggested amounts editor
- amount
- impact label
- sort order
- active flag

### Need items editor
- category
- title
- target amount
- covered amount
- status
- urgency flag

## 17. Responsive Rules

### Mobile priorities
- Hero must explain the case within first screen and a half
- Progress module must appear early
- CTA must remain visible without clutter
- Cards should stack with clear separation

### Desktop priorities
- Use asymmetry carefully
- Keep line length under control
- Avoid stretching text blocks across full width

## 18. SEO and Accessibility Notes

### SEO
- Each cause needs one clear H1
- Strong meta title and description
- Open Graph image from main cause image

### Accessibility
- Respect contrast ratios
- Visible focus states
- Buttons and amount chips need obvious keyboard states
- Progress bars should include text labels, not color only

## 19. Recommended Implementation Order

1. Add the Croodev logo to `public/branding/croodev-logo.svg`.
2. Load `Manrope` and `Cormorant Garamond` or `Fraunces`.
3. Define CSS variables in `tokens.css`.
4. Build shared Blade components before assembling pages.
5. Implement public header, footer, hero, and donation components first.
6. Reuse the same design tokens in the admin instead of inventing a second UI language.

## 20. Handoff Notes For Backend/Main Agent

### Critical implementation decisions already made
- Product name: `Croodev Care`
- Visual direction: `Quiet Assurance`
- Logo style: monochrome official SVG
- Public and admin should share the same token system
- Suggested amount controls should be premium chips/cards, not plain list buttons
- Transparency section is mandatory and should be near the end of the page, before FAQ/footer

### Non-negotiables
- No Bootstrap aesthetic
- No purple accents
- No generic NGO template cards
- No lorem ipsum
- No crowded admin tables
- No separate admin theme disconnected from the public brand
