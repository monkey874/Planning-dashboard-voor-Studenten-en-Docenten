---
name: assistant
description: Describe what this custom agent does and when to use it.
argument-hint: ik wil dat je een template maakt steeds in de map ai logboek rick ## Doel van het AI-logboek

Het doel is niet om aan te tonen hoeveel AI is gebruikt.

Het doel is om te laten zien dat je:

- AI bewust inzet;
- AI-output kritisch kunt beoordelen;
- fouten en beperkingen kunt herkennen;
- gegenereerde code begrijpt;
- zelfstandig technische keuzes kunt maken.

AI is een hulpmiddel, geen vervanging van je eigen vakkennis.

---

## Minimale inhoud per registratie

Leg bij iedere AI-interactie (automatisch // kopieer deze instructies in de chat/prompt) vast.

### Datum

Wanneer heb je AI gebruikt?

### Taak

Wat probeerde je te bereiken?

Voorbeeld:

> Ontwikkelen van een API-endpoint voor het toevoegen van activiteiten.

### Prompt

Welke prompt heb je gebruikt?

Voorbeeld:

```text
Maak een ASP.NET Core API-endpoint waarmee een docent een activiteit kan toevoegen aan een SQL Server database.
```

### Outputsamenvatting

Beschrijf kort wat AI heeft gegenereerd.

Voorbeeld:

> AI genereerde een controller, modelklasse en Entity Framework-configuratie.

### Kritische beoordeling

Beantwoord minimaal de volgende vragen:

- Was de oplossing correct?
- Begrijp ik de gegenereerde code?
- Welke onderdelen waren onduidelijk?
- Welke fouten of tekortkomingen ontdekte ik?
- Hoe heb ik dat gecontroleerd?

### Eigen aanpassingen

Welke wijzigingen heb je zelf gedaan?

Voorbeeld:

- Validatie toegevoegd.
- Variabelen hernoemd.
- SQL-query aangepast.
- Foutafhandeling toegevoegd.

### Resultaat

Wat heeft de AI-interactie uiteindelijk opgeleverd?

---

## Voorbeeldregistratie

```markdown
# AI-logboek

## 2026-09-15

### Taak

Databasemodel maken voor activiteiten.

### Prompt

Maak een Entity Framework model voor een activiteit met datum, starttijd, eindtijd, locatie en beschrijving.

### Outputsamenvatting

Copilot genereerde een C# modelklasse.

### Kritische beoordeling

De gegenereerde klasse werkte grotendeels correct.
Validatie voor verplichte velden ontbrak.
Daarnaast was de locatie optioneel terwijl dit volgens de requirements niet wenselijk was.

### Eigen aanpassingen

- Required-attributen toegevoegd.
- Maximale veldlengtes ingesteld.
- Commentaar toegevoegd.

### Resultaat

Werkend databasemodel opgenomen in de applicatie.
```

---

# Beoordeling

---

# Beoordeling AI-logboek

Binnen het onderdeel "Gebruik van AI en Copilot" wordt specifiek gekeken naar:

| Criterium | Weging |
|------------|---------:|
| Kwaliteit van prompts | 20% |
| Reflectie op AI-output | 30% |
| Kritische beoordeling | 30% |
| Eigen verbeteringen en inzichten | 20% |

---

# Belangrijk

Het overnemen van AI-output zonder aantoonbare beoordeling of begrip wordt beschouwd als onvoldoende gebruik van AI.

De beoordelaar moet uit het AI-logboek kunnen afleiden dat:

- de student begrijpt wat de gegenereerde code doet;
- de student kritisch heeft gekeken naar de output;
- de student zelfstandig keuzes heeft gemaakt;
- AI is ingezet als hulpmiddel en niet als vervanging van eigen denkwerk.

---.
# tools: ['vscode', 'execute', 'read', 'agent', 'edit', 'search', 'web', 'todo'] # specify the tools this agent can use. If not set, all enabled tools are allowed.
---

<!-- Tip: Use /create-agent in chat to generate content with agent assistance -->

Define what this custom agent does, including its behavior, capabilities, and any specific instructions for its operation.