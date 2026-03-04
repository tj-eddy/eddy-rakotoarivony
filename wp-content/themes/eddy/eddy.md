# 🎯 Prompt — Portfolio Développeur Web

---

## Objectif

Crée un **portfolio one-page** complet en **HTML / CSS / jQuery** pour un développeur freelance spécialisé en :

- PrestaShop
- WordPress
- Symfony
- Maintenance de sites web

---

## 🎨 Identité visuelle

- **Couleur principale** : Aquamarine (`#7FFFD4`) et ses nuances (tons sombres/clairs)
- **Thème** : Sombre (dark background) avec accents aquamarine lumineux
- **Typographie** : Choisir une paire de polices Google Fonts élégante et moderne (ex : titre en display, corps en sans-serif raffiné — éviter Inter, Arial, Roboto)
- **Ambiance** : Professionnel, tech, moderne, propre — avec une touche créative

---

## 📐 Structure des sections

### 1. `Hero`
- Plein écran
- Nom / titre accrocheur du développeur
- Courte description (ex : "Expert PrestaShop · WordPress · Symfony")
- Bouton CTA (ex : "Voir mes services" ou "Me contacter")
- Animation d'entrée : apparition en fondu/slide des éléments au chargement

### 2. `Services`
- 4 cartes : PrestaShop, WordPress, Symfony, Maintenance
- Chaque carte : icône (SVG ou Font Awesome), titre, courte description
- Animation : les cartes s'animent à l'entrée dans le viewport (scroll reveal)
- Effet hover soigné sur les cartes

### 3. `Actualités`
- 3 articles fictifs (titre, date, extrait de texte, lien "Lire plus")
- Mise en page en grille
- Animation au scroll

### 4. `Contact`
- Formulaire simple : Nom, Email, Message, Bouton Envoyer
- Icônes de réseaux sociaux (LinkedIn, GitHub, etc.)
- Animation subtile sur le focus des champs

---

## 🧭 Navigation

### 🍔 Menu Burger Vertical — Desktop & Mobile (même comportement partout)

- **Pas de navbar horizontale** — le menu burger est présent **sur toutes les tailles d'écran** (desktop inclus)
- **Icône burger fixe** : positionnée en haut à droite (`position: fixed`), toujours visible
- Au clic, un **panneau latéral vertical** s'ouvre depuis la droite (ou la gauche) avec une animation fluide (`slideInRight` ou `translateX`)
- Le panneau couvre partiellement l'écran (ex : 300px de large) avec un **fond semi-transparent foncé / glassmorphism**
- Les **liens de navigation s'animent en cascade** (apparition décalée un par un, `stagger delay`) à l'ouverture du menu
- Chaque lien est grand, lisible, avec un **effet hover aquamarine** (underline animé ou glow)
- Un **overlay sombre** s'affiche derrière le panneau au clic ; cliquer dessus referme le menu
- L'icône burger se transforme en ✕ (croix animée CSS) quand le menu est ouvert
- **Scroll actif** : le lien correspondant à la section visible est mis en surbrillance dans le panneau
- Transition fluide (smooth scroll jQuery) vers la section au clic sur un lien, puis fermeture automatique du panneau

---

## ✨ Animations & Effets

- Utiliser **jQuery** pour :
  - Scroll reveal des éléments au défilement
  - Navigation active au scroll
  - Smooth scroll sur les ancres
  - Toggle du menu mobile
- Utiliser **CSS animations / transitions** pour :
  - Effets d'entrée (fade, slide, scale)
  - Hover sur les cartes, boutons, liens
  - Curseur ou dégradé animé dans le Hero
- Ajouter un **effet de particules ou fond animé** dans le Hero (CSS pur ou légère lib JS)

---

## ⚙️ Contraintes techniques

- **Fichier unique** : tout en un seul fichier HTML (CSS en `<style>`, JS en `<script>`)
- Dépendances autorisées via CDN uniquement :
  - jQuery
  - Font Awesome (icônes)
  - Google Fonts
- **Responsive** : mobile, tablette, desktop
- Code **propre, commenté et bien structuré**
- Contenu en **français**

---

## ✅ Résultat attendu

Un portfolio visuellement soigné, animé, professionnel, 100% fonctionnel en une seule page HTML, prêt à être personnalisé avec les vraies informations du développeur.