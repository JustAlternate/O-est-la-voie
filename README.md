# Le Projet "Où est la voie"

En escalade, les murs sont parsemé de prises de couleur, chaque voie respecte ainsi une couleur qui permet d'avoir sur un seul et meme mur d'escalade plusieurs voies de plusieurs difficulté en meme temps. Un grimpeur experimenté peut ainsi grimper sur le meme mur qu'un grimpeur debutant en utilisant un code couleur coté plus dur.

Ainsi pour faciliter le travail de reperage du grimpeur et car certaine fois il est difficile de trouver toutes les prises d'une meme couleur, J'ai imaginer un service facile d'acces qui permettrais a n'importe quelle grimpeur de rapidement pouvoir visualiser toutes les prises de la couleur qu'il souhaite.

Ce service s'appelle "Où est la voie" et il prend forme sous l'apparence d'un site web accesible a cette adresse : http://justalternate.fr/wall_holds_recognition/

## Comment utiliser Où est la voie ?

1) Pour utilisez "Où est la voie" la premiere étapes est de photographier votre mur d'escalade. Assurez vous d'avoir une photo bien nette et bien éclairée, faites en sorte d'avoir une photo pas trop lourde (maximum 8 Mega octets 'mo').

2) Ensuite retournez sur le site et faites, "Choisir un fichier", puis choisisez la photo que vous venez de faire.

3) Puis il faudra selectionnez une couleur, assurez vous de prendre une couleur la plus proche possible de la couleur des prises que vous voulez filtrer (sinon ça ne marchera pas)

4) Ensuite une dernière étape est obligatoire, la sensibilité du filtrage, étant donnée que les couleurs sont subjectives a chaqu'un, un rouge clair pour certains peut etre un rose foncé pour d'autre il faudra selectionnez une sensibilité pour que le filtrage se fasse correctement. En general si votre choix de couleur est correct, une sensibilité a 10 devrait être suffisante.

5) Enfin appuyé sur 'Envoyer' et attendais une petite dizaine de secondes.

Si tout a fonctionner correctement, vous devrais voir votre image filtré s'afficher en dessous du site.

## Limites de l'application

Tout systemes a ces limites et "Où est la voie" n'est pas une exception.  

Si votre filtrage n'a pas fonctionné : 

- La couleur selectionnez n'etais peut être pas assez proche de la réalité.
- La sensibilité selectionnez n'etais peut être pas assez forte ou bien l'était telle trop.
- Votre connection était peut être instable ou bien trop lente.
- Le transfert à peut être était coupé.
- L'image envoyé était trop grosse ou bien corompus.
- Le serveur sur lequel est hebergé "Où est la voie" est peut-etre surcharger.
- Le site et l'application a des bugs internes.

## Comment ça marche ?

Attention ce paragraphe est rempli de termes informatique donnée sans aucune explication.

"Où est la voie" est découpée en 2 parties :

1) Le coté serveur qui traite l'image envoyée et genere une nouvelle image filtré.
2) Le coté client qui permet a l'utilisateur de selectionnez une image, une couleur et une sensibilité.

Le coté serveur est hebergé sur un VPS sous Linux Centos7, il utilise uniquement du Python3 et la librairie OpenCV2 pour faire le filtrage de l'image.

Le coté client est hebergé sur le meme VPS mais utilise du PHP, HTML, CSS et JavaScript afin de donner une interface a l'utilisateur.

Languages de programmation utilisée : HTML/CSS(~60%), PHP(~20%), Python(~15%), JavaScript(~5%)
