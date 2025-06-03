from flask import Flask, render_template, request, jsonify
from flask_sqlalchemy import SQLAlchemy
from datetime import datetime
import hashlib

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///scoreboard.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)

# Define the correct flags and their point values
CORRECT_FLAGS = {
    'FLAG{hidden_in_plain_sight}': 100,
    'FLAG{metadata_mystery}': 100,
    'FLAG{data_in_details}': 100,
    'FLAG{behind_the_scenes}': 100,
    'FLAG{apache_2_2_3_vulnerable}': 200,
    'FLAG{multiple_ssh_ports}': 200,
    'FLAG{sqli_vulnerable_php}': 200,
    'FLAG{ghostcat_vulnerability}': 200
}

class Team(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(50), unique=True, nullable=False)
    points = db.Column(db.Integer, default=0)
    flags = db.Column(db.String(500), default='')  # Store found flags as comma-separated values
    last_submission = db.Column(db.DateTime, default=datetime.utcnow)

with app.app_context():
    db.create_all()

@app.route('/')
def index():
    teams = Team.query.order_by(Team.points.desc()).all()
    return render_template('index.html', teams=teams)

@app.route('/submit', methods=['POST'])
def submit_flag():
    team_name = request.form.get('team_name')
    flag = request.form.get('flag')
    
    if not team_name or not flag:
        return jsonify({'error': 'Missing team name or flag'}), 400
    
    # Get or create team
    team = Team.query.filter_by(name=team_name).first()
    if not team:
        team = Team(name=team_name)
        db.session.add(team)
    
    # Check if flag is correct and not already submitted
    if flag in CORRECT_FLAGS and flag not in team.flags.split(','):
        team.points += CORRECT_FLAGS[flag]
        team.flags = team.flags + ',' + flag if team.flags else flag
        team.last_submission = datetime.utcnow()
        db.session.commit()
        return jsonify({'success': True, 'message': 'Flag submitted successfully!'})
    
    return jsonify({'error': 'Invalid or already submitted flag'}), 400

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000) 