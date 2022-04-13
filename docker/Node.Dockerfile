FROM node:17
WORKDIR /var/www

COPY package*.json ./
COPY webpack*.mix ./
# Продакшн-сборка
RUN npm install
RUN npm run development
COPY . .
# Удаление папки с npm-модулями
RUN rm -rf node_modules
# Уведомление о порте, который будет прослушивать работающее приложение
EXPOSE 3000
# Запуск проекта
CMD ["npm", "start"]
