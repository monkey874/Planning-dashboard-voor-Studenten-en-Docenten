# AI-logboek

## 2026-09-18

### Taak
De gebruikersrollen en permissies voor docenten en superbeheerder vastleggen, en daarna de minimale activiteiten-CRUD implementeren.

### Prompt
Maak in Laravel een permissiesysteem met rollen voor student, docent en superbeheerder. Docenten mogen activiteiten aanmaken, wijzigen en verwijderen. Superbeheerders mogen docentenrollen toewijzen en verwijderen, en mogen ook activiteiten beheren.

### Outputsamenvatting
AI genereerde een passende Spatie Permission-opzet met rollen, permissies en tests om de rechten te controleren.

### Kritische beoordeling
De oplossing was in grote lijnen correct. Ik begreep de structuur van de roles en permissions, maar ik moest zelf controleren of de permissies een goede match waren met de projectvereisten. De belangrijkste tekortkoming was dat ik de daadwerkelijke activiteit-CRUD nog niet had: de routes en model moesten nog echt worden toegevoegd.

### Eigen aanpassingen
- Rollen en permissies beperkt tot de gevraagde scope.
- Docenten kregen volledige activiteitenrechten.
- Superbeheerders kregen de docentrol/rolverwijderingsrechten.
- De test werd aangepast zodat alleen deze scope werd gecontroleerd.

### Resultaat
De rol-permissie-opzet werkt en is getest. Daarna kon ik de echte activiteit-CRUD implementeren, zodat de app functioneel verdergaat volgens de opdracht.