pipeline {
    agent any

    stages {
        stage('Checkout SCM') {
            steps {
                checkout scm
            }
        }

        stage('Checkout Code') {
            steps {
                echo 'Cloning public GitHub repository...'
                git branch: 'main', url: 'https://github.com/pashaputri03/ccpsh.git/'
            }
        }
}


