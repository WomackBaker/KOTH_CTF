from flask import Flask, render_template, request, redirect, url_for, flash
from flask_sqlalchemy import SQLAlchemy
from flask_login import LoginManager, UserMixin, login_user, login_required, logout_user, current_user
from werkzeug.security import generate_password_hash, check_password_hash
import os
import json
from datetime import datetime

app = Flask(__name__)
app.config['SECRET_KEY'] = os.urandom(24)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///data/scoreboard.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db = SQLAlchemy(app)
login_manager = LoginManager()
login_manager.init_app(app)
login_manager.login_view = 'login'

# Get flags and points from flags.txt file
with open('flags.txt', 'r') as f:
    lines = [line.strip() for line in f if line.strip()]
    FLAGS = []
    POINTS = []
    for line in lines:
        if ',' in line:
            flag, points = line.rsplit(',', 1)
            FLAGS.append(flag.strip())
            POINTS.append(int(points.strip()))
        else:
            # Handle lines without points (default to 100)
            FLAGS.append(line.strip())
            POINTS.append(100)

class User(UserMixin, db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(80), unique=True, nullable=False)
    password_hash = db.Column(db.String(120), nullable=False)
    solved_flags = db.Column(db.String(1000), default='[]')  # JSON string of solved flags
    points = db.Column(db.Integer, default=0)
    flag_timestamps = db.Column(db.String(1000), default='[]')  # JSON string of timestamps

    def get_solved_flags(self):
        return json.loads(self.solved_flags)

    def get_flag_timestamps(self):
        return json.loads(self.flag_timestamps)

    def add_solved_flag(self, flag):
        solved = self.get_solved_flags()
        timestamps = self.get_flag_timestamps()
        if flag not in solved:
            solved.append(flag)
            timestamps.append(datetime.now().timestamp())
            self.solved_flags = json.dumps(solved)
            self.flag_timestamps = json.dumps(timestamps)
            # Add points for the flag
            flag_index = FLAGS.index(flag)
            self.points += POINTS[flag_index]
            db.session.commit()

    def to_dict(self):
        return {
            'id': self.id,
            'username': self.username,
            'points': self.points,
            'solved_flags': self.get_solved_flags(),
            'timestamps': self.get_flag_timestamps()
        }

@login_manager.user_loader
def load_user(user_id):
    return User.query.get(int(user_id))

@app.route('/')
def index():
    users = User.query.order_by(User.points.desc()).all()
    users_data = [user.to_dict() for user in users]
    return render_template('index.html', users=users, users_data=users_data, flag_count=len(FLAGS))

@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        username = request.form.get('username')
        password = request.form.get('password')
        
        if User.query.filter_by(username=username).first():
            flash('Username already exists')
            return redirect(url_for('register'))
        
        user = User(
            username=username,
            password_hash=generate_password_hash(password)
        )
        db.session.add(user)
        db.session.commit()
        
        return redirect(url_for('login'))
    return render_template('register.html')

@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form.get('username')
        password = request.form.get('password')
        user = User.query.filter_by(username=username).first()
        
        if user and check_password_hash(user.password_hash, password):
            login_user(user)
            return redirect(url_for('dashboard'))
        
        flash('Invalid username or password')
    return render_template('login.html')

@app.route('/logout')
@login_required
def logout():
    logout_user()
    return redirect(url_for('index'))

@app.route('/dashboard', methods=['GET', 'POST'])
@login_required
def dashboard():
    if request.method == 'POST':
        flag = request.form.get('flag')
        if flag in FLAGS and flag not in current_user.get_solved_flags():
            current_user.add_solved_flag(flag)
            flash('Flag submitted successfully!')
        else:
            flash('Invalid or already submitted flag')
    
    solved_flags = current_user.get_solved_flags()
    flag_status = [(flag, flag in solved_flags) for flag in FLAGS]
    return render_template('dashboard.html', flag_status=flag_status)

def init_db():
    with app.app_context():
        # Drop all tables and recreate them
        db.drop_all()
        db.create_all()

if __name__ == '__main__':
    # Only initialize the database if it does not exist
    db_path = os.path.join('data', 'scoreboard.db')
    if not os.path.exists(db_path):
        init_db()
    app.run(host='0.0.0.0', port=8000)