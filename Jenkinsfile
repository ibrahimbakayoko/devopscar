pipeline {
    agent any

    environment {
        DOCKER_IMAGE = 'dnais1210/devopscar'
        DOCKER_CREDENTIALS = 'docker-hub-credentials'
        // KUBE_CONFIG = '/root/.kube/config' // Chemin vers ton fichier kubeconfig
    }

    stages {
        stage('Cloner le code') {
            steps {
                git branch: 'main', url: 'https://github.com/ibrahimbakayoko/devopscar.git'
            }
        }

        stage('Construire l’image Docker') {
            steps {
                script {
                    sh 'docker build -t $DOCKER_IMAGE:$BUILD_NUMBER  .'
                }
            }
        }

        stage('Pousser sur Docker Hub') {
            steps {
                script {
                    withDockerRegistry([credentialsId: "$DOCKER_CREDENTIALS", url: ""]) {
                        sh 'docker push $DOCKER_IMAGE:$BUILD_NUMBER'
                    }
                }
            }
        }

         stage('Déployer sur Kubernetes') {
             steps {
                 script {
                     sh 'docker-compose up -d'
                    // sh 'kubectl apply -f k8s/service.yaml'
                 }
             }
        }
    }
}

