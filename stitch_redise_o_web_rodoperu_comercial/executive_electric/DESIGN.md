---
name: Executive Electric
colors:
  surface: '#faf8ff'
  surface-dim: '#d2d9f4'
  surface-bright: '#faf8ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f2f3ff'
  surface-container: '#eaedff'
  surface-container-high: '#e2e7ff'
  surface-container-highest: '#dae2fd'
  on-surface: '#131b2e'
  on-surface-variant: '#434656'
  inverse-surface: '#283044'
  inverse-on-surface: '#eef0ff'
  outline: '#737687'
  outline-variant: '#c3c5d9'
  surface-tint: '#004fe4'
  primary: '#0047cc'
  on-primary: '#ffffff'
  primary-container: '#155dfc'
  on-primary-container: '#eceeff'
  inverse-primary: '#b6c4ff'
  secondary: '#765a23'
  on-secondary: '#ffffff'
  secondary-container: '#fed894'
  on-secondary-container: '#785c25'
  tertiary: '#992f00'
  on-tertiary: '#ffffff'
  tertiary-container: '#c33e00'
  on-tertiary-container: '#ffebe5'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#dce1ff'
  primary-fixed-dim: '#b6c4ff'
  on-primary-fixed: '#00164e'
  on-primary-fixed-variant: '#003baf'
  secondary-fixed: '#ffdea6'
  secondary-fixed-dim: '#e6c180'
  on-secondary-fixed: '#271900'
  on-secondary-fixed-variant: '#5b430c'
  tertiary-fixed: '#ffdbd0'
  tertiary-fixed-dim: '#ffb59c'
  on-tertiary-fixed: '#390c00'
  on-tertiary-fixed-variant: '#832700'
  background: '#faf8ff'
  on-background: '#131b2e'
  surface-variant: '#dae2fd'
typography:
  display:
    fontFamily: Roboto Flex
    fontSize: 56px
    fontWeight: '800'
    lineHeight: 64px
    letterSpacing: -0.03em
  display-mobile:
    fontFamily: Roboto Flex
    fontSize: 38px
    fontWeight: '800'
    lineHeight: 44px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Roboto Flex
    fontSize: 40px
    fontWeight: '700'
    lineHeight: 48px
    letterSpacing: -0.025em
  headline-lg-mobile:
    fontFamily: Roboto Flex
    fontSize: 30px
    fontWeight: '700'
    lineHeight: 36px
    letterSpacing: -0.02em
  headline-md:
    fontFamily: Roboto Flex
    fontSize: 28px
    fontWeight: '600'
    lineHeight: 36px
    letterSpacing: -0.015em
  headline-sm:
    fontFamily: Roboto Flex
    fontSize: 22px
    fontWeight: '600'
    lineHeight: 28px
    letterSpacing: -0.01em
  title:
    fontFamily: Roboto Flex
    fontSize: 18px
    fontWeight: '600'
    lineHeight: 24px
    letterSpacing: -0.005em
  body-lg:
    fontFamily: Roboto Flex
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
    letterSpacing: 0em
  body-md:
    fontFamily: Roboto Flex
    fontSize: 15px
    fontWeight: '400'
    lineHeight: 24px
    letterSpacing: 0em
  body-sm:
    fontFamily: Roboto Flex
    fontSize: 13px
    fontWeight: '400'
    lineHeight: 20px
    letterSpacing: 0.01em
  label-md:
    fontFamily: Roboto Flex
    fontSize: 14px
    fontWeight: '500'
    lineHeight: 18px
    letterSpacing: 0.02em
  label-sm:
    fontFamily: Roboto Flex
    fontSize: 11px
    fontWeight: '600'
    lineHeight: 14px
    letterSpacing: 0.08em
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  gutter: 1.5rem
  gutter-mobile: 1rem
  margin: 3rem
  margin-mobile: 1.25rem
  space-xs: 0.25rem
  space-sm: 0.5rem
  space-md: 1rem
  space-lg: 1.5rem
  space-xl: 2.5rem
---

## Brand & Style

This design system establishes an authoritative yet high-energy corporate identity tailored for modern industry leadership. It replaces conventional corporate navy with an electric, forward-propelling royal cobalt, balancing institutional trust with high-tech momentum. Warm metallic gold serves as an intentional secondary accent, imparting prestige and precision craftsmanship.

The visual style blends **Corporate / Modern** rigor with **Minimalist** clarity:
- Confident, expansive whitespace framing dense, technical information cleanly.
- Strict architectural lines softened only by subtle geometric corner treatments.
- A high-contrast palette that evokes clarity, velocity, and institutional scale.
- Utilitarian precision that communicates operational efficiency and engineering excellence.

## Colors

The palette is engineered around energetic clarity and corporate heritage:

- **Primary (`#155DFC`)**: Electric Cobalt Blue. The dominant brand tone used for primary actions, active navigational states, and focal metrics. It injects dynamism into enterprise-grade interfaces.
- **Secondary (`#B39255`)**: Executive Warm Gold. Applied sparingly for prestige badging, verified certifications, architectural accents, and secondary visual tags. Never used for destructive or routine actions.
- **Neutral Core (`#0F172A`)**: Deep Slate. Serves as high-contrast primary text, deep structural footers, and contrast containment blocks.
- **Surface Neutrals**: A multi-tiered cool surface stack using pure White (`#FFFFFF`) for elevated cards, Canvas Tint (`#F8FAFC`) for page backgrounds, and Subtle Border (`#E2E8F0`) for structural divisions.

### State & Contrast Mapping
- **Interactive Hover**: Primary brightens to `#2E72FD` on interaction; active press settles at `#0D47C9`.
- **Text On Primary**: Exclusively pure `#FFFFFF` with strict WCAG AAA conformance across all scales.
- **Text On Gold**: Rich Slate `#0F172A` to maintain readability without muddying the metallic character.

## Typography

The design system unifies all touchpoints under `Roboto Flex`, deploying its structured, mechanical cadence to project industrial precision and operational clarity.

- **Headings**: Heavy weights (`700`, `800`) paired with controlled negative letter-spacing project executive authority and modern industrial capability.
- **Body**: Regular weights (`400`) balanced with generous vertical line-height ensure dense operational disclosures, technical specifications, and corporate narratives remain effortless to scan.
- **Labels & Overlines**: Uppercase micro-labels (`label-sm`) with wide tracking (`0.08em`) create structured, technical meta-information tags reminiscent of industrial blueprint markers.

## Layout & Spacing

A strictly regimented 12-column responsive layout anchors all corporate documentation, service breakdowns, and data views.

- **Desktop (≥1200px)**: 12 columns with a fixed container max-width of 1280px, flanked by minimum `3rem` margins and `1.5rem` gutters.
- **Tablet (768px - 1199px)**: 8 columns with dynamic gutters (`1.5rem`) and `2rem` outer canvas padding.
- **Mobile (<768px)**: 4 columns with `1rem` gutters and `1.25rem` margins. Complex analytical tables collapse into structured linear cards.

Spacing between interior elements follows an 8-point base rhythm, avoiding arbitrary values to guarantee crisp visual cadence across technical dashboards and marketing landing sections alike.

## Elevation & Depth

Depth is established through a synthesis of **tonal surface separation** and **engineered micro-shadows**, rejecting muddy drop-shadows in favor of crisp, precise structural layers.

- **Level 0 (Base Canvas)**: Background `#F8FAFC`. Zero elevation.
- **Level 1 (Structural Cards & Modules)**: Background `#FFFFFF`, bounded by a hairline border (`1px solid #E2E8F0`) and an ambient, blue-tinted micro-shadow: `0 1px 3px rgba(15, 23, 42, 0.05), 0 1px 2px rgba(15, 23, 42, 0.03)`.
- **Level 2 (Dropdowns, Floating Navigation, Hovered Cards)**: Background `#FFFFFF`, border `1px solid #CBD5E1`, with elevation `0 10px 15px -3px rgba(21, 93, 252, 0.08), 0 4px 6px -2px rgba(15, 23, 42, 0.04)`.
- **Level 3 (Modals & Executive Dialogs)**: Backed by a high-contrast dark overlay (`#0F172A` at 60% opacity), elevated by `0 20px 25px -5px rgba(15, 23, 42, 0.15), 0 8px 10px -6px rgba(15, 23, 42, 0.08)`.

## Shapes

The design system maintains a **Soft (`1`)** shape profile to project engineered reliability and institutional sturdiness without appearing sharp or brutalist:

- **Core Elements (Buttons, Inputs, Badges)**: Bound to `0.25rem` (4px) corner radii. This conveys deliberate architectural discipline.
- **Large Panels & Feature Cards (`rounded-lg`)**: Defined at `0.5rem` (8px) for structural framing.
- **Executive Badges & Micro-Pills**: May utilize fully rounded geometric ends only when signifying real-time operational status (e.g., active fleet tracking, operational status indicators).

## Components

### Buttons
- **Primary**: Solid electric blue (`#155DFC`), text `#FFFFFF`, 4px radius, padded with `0.75rem 1.5rem`. Subtle hover shift to `#2E72FD` with a crisp 1px electric outline glow.
- **Secondary (Prestige)**: Outlined `#B39255` border (1.5px) over transparent or white background; text `#8C6D32` with hover filling to `#FDFCF7`.
- **Tertiary / Ghost**: Transparent fill, slate text (`#334155`), with hover state revealing a soft `#F1F5F9` background.

### Input Fields & Controls
- **Fields**: Flat `#FFFFFF` surface with a crisp `1px solid #CBD5E1` boundary. Focus state applies a vivid `2px solid #155DFC` border with no diffuse blur, emphasizing mechanical precision.
- **Checkboxes & Radios**: 4px radius for checkboxes, full circle for radios. Checked state fills with `#155DFC` carrying a sharp white vector glyph.

### Badges & Chips
- **Corporate Status Chips**: Compact uppercase text (`label-sm`). Neutral state: `#F1F5F9` fill with `#475569` text.
- **Executive / Gold Tier Chips**: Pale warm champagne base (`#FAF6EF`), fine border (`#E4D4B5`), and `#8C6D32` text.

### Cards & Modular Containers
- Pure white container with a 4px corner radius, hairline `#E2E8F0` frame, and an optional 3px solid `#155DFC` top-accent band on highlighted enterprise solutions.
- Interactive cards elevate smoothly on hover via subtle Level 2 blue-tinted elevation.

### Specialized Component: Technical Metric Block
- Large display figure (`Roboto Flex`, weight `800`, electric blue `#155DFC`) coupled with a tracked uppercase category caption (`label-sm`, deep slate `#64748B`), separated by a clean hairline divider.