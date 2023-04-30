# Dockerfile
FROM node:18-alpine

# Defina o diretório de trabalho
WORKDIR /app

# Adicione `/app/node_modules/.bin` para $PATH
ENV PATH /app/node_modules/.bin:$PATH

# Instale as dependências da aplicação
COPY package.json ./
COPY package-lock.json ./
RUN npm install

# Adicione o código da aplicação
COPY . ./

# Inicie a aplicação
CMD ["npm", "start"]

EXPOSE 3000
