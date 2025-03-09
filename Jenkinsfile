pipeline {
    agent any

    environment {
        IMAGE_NAME = 'dnais1210/devopscar'
        CONTAINER_NAME = 'php_app'
        DOCKER_CREDENTIALS = 'docker-hub-credentials'
    }

    stages {
        stage('Checkout Code') {
            steps {
                git 'https://github.com/ibrahimbakayoko/devopscar.git'  // Remplace par ton repo
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    sh "docker build -t ${IMAGE_NAME}:$BUILD_ID ."
                }
            }
        }

        stage('Login to Docker Hub') {
            steps {
                script {
                    withCredentials([usernamePassword(credentialsId: DOCKER_CREDENTIALS, usernameVariable: 'DOCKER_USER', passwordVariable: 'DOCKER_PASS')]) {
                        sh "echo $DOCKER_PASS | docker login -u $DOCKER_USER --password-stdin"
                    }
                }
            }
        }

        stage('Push Image to Docker Hub') {
            steps {
                script {
                    sh "docker push ${IMAGE_NAME}:$BUILD_ID"
                }
            }
        }

        stage('Deploy with Docker Compose') {
            steps {
                script {
                    sh "docker-compose down || true"
                    sh "docker-compose up -d"
                }
            }
        }
    }

    post {
        always {
            sh "docker logout"
        }
    }
}
