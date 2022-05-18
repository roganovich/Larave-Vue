FROM node:17
WORKDIR /var/www
# Копирование установочных файлов
COPY . /var/www
# Cборка
RUN npm install
RUN npm run dev

#RUN npm run development
# Копирование сборки обратно
# Удаление папки с npm-модулями
#RUN rm -rf node_modules
# Уведомление о порте, который будет прослушивать работающее приложение
EXPOSE 3000
# Запуск проекта
ENTRYPOINT ["npm", "run"]


