# Déploiement / Migration
Prendre le code d'une machine ===> pour le faire fonctionner sur une autre machine


## Challenges :

- Système d'exploitation différent :
==> Linux
==> Windows


- BDD différent :
===> SQLITE
===> MySQL / MariaDB


- Plusieurs développeurs sur le mm projet :
===> Réconcilier le travail sachant que 1 seule machine finale
===> installer tous les binaires nécessaires sur les machines (php / composer / git ...)


## Objectif :
===> Réussir ces migrations de manière FIABLE

- Série de tests automatisés :
      - Code qui va verifier mon code:
            - Ouvrir une page web
            - Remplir un formulaire
            - verifier que tout est OK en BDD