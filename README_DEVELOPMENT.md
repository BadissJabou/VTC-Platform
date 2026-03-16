# VTC Platform - Guide de Développement

## 🚀 Démarrage Rapide

### Prérequis
- PHP 8.2+
- Composer
- Node.js 18+
- SQLite

### Installation
```bash
# Cloner le projet
git clone https://github.com/BadissJabou/VTC-Platform.git
cd VTC-Platform

# Installation dépendances
composer install
npm install

# Configuration
cp .env.example .env
php artisan key:generate

# Base de données
php artisan migrate
php artisan db:seed

# Assets
npm run build

# Démarrer
php artisan serve
```

---

## 🧪 Tests

### Lancer tous les tests
```bash
php artisan test
```

### Tests spécifiques
```bash
# Tests unitaires
php artisan test --testsuite=Unit

# Tests fonctionnels
php artisan test --testsuite=Feature

# Test spécifique
php artisan test --filter=ServiceTest
```

### Couverture
```bash
php artisan test --coverage
```

---

## 📁 Architecture du Projet

### Structure des dossiers
```
VTC_Plateforme/
├── app/
│   ├── Http/Controllers/     # Logique de routage
│   ├── Models/              # Modèles Eloquent
│   └── Providers/           # Services providers
├── database/
│   ├── migrations/          # Structure BDD
│   └── seeders/            # Données de test
├── resources/views/        # Templates Blade
├── routes/                 # Routes HTTP
├── tests/                  # Tests
└── public/                 # Assets publics
```

### Modèles principaux
- **Service** : Types de services VTC
- **Booking** : Réservations clients
- **Review** : Avis clients
- **Quote** : Devis personnalisés
- **User** : Utilisateurs (clients/admins)

---

## 🔧 Développement

### Scripts Composer utiles
```bash
# Installation complète
composer run setup

# Environnement de développement
composer run dev

# Tests
composer run test
```

### Scripts NPM
```bash
# Développement
npm run dev

# Production
npm run build
```

---

## 📋 Bonnes Pratiques

### Code Style
- Respecter PSR-12
- Commenter la logique métier
- Utiliser les types hints

### Tests
- Couverture minimale 80%
- Tests unitaires pour les modèles
- Tests fonctionnels pour les contrôleurs

### Git
- Commits atomiques
- Messages clairs
- Branche par fonctionnalité

---

## 🐛 Dépannage

### Problèmes courants
1. **Vite Manifest Error**
   ```bash
   npm run build
   ```

2. **Database not found**
   ```bash
   touch database/database.sqlite
   php artisan migrate
   ```

3. **Permissions**
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

---

## 📚 Documentation

- [Cahier des charges](./CAHIER_DE_CHARGES_VTC_PLATFORM.md)
- [API Documentation](./docs/api.md)
- [Guide d'administration](./docs/admin.md)

---

## 🚀 Déploiement

### Production
```bash
# Optimisation
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Assets
npm run build

# Permissions
chmod -R 755 storage bootstrap/cache
```

### Variables d'environnement
```env
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
DB_HOST=your-host
DB_DATABASE=vtc_platform
```

---

## 🤝 Contribuer

1. Forker le projet
2. Créer une branche `feature/nom-fonctionnalite`
3. Commiter les changements
4. Pousser vers la branche
5. Créer une Pull Request

---

## 📞 Support

Pour toute question ou problème :
- Créer une issue sur GitHub
- Contacter l'équipe de développement
- Consulter la documentation

---

**© 2026 VTC Platform - Plateforme professionnelle pour chauffeurs VTC**
