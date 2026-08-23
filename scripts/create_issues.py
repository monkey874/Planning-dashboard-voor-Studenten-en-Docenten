import yaml
import subprocess

with open("scripts/backlog.yml", "r", encoding="utf-8") as f:
    data = yaml.safe_load(f)

for issue in data["issues"]:
    title = issue["title"]
    body = issue["body"]
    labels = issue.get("labels", [])

    cmd = [
        "gh", "issue", "create",
        "--title", title,
        "--body", body
    ]

    for label in labels:
        cmd.extend(["--label", label])

    print(f"Creating issue: {title}")
    subprocess.run(cmd)
